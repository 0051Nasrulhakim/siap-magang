<?php

namespace App\Controllers;

class Home extends BaseController
{

    protected $angkatan;
    protected $jurusan;
    protected $user;
    protected $siswa;
    protected $tempat;
    protected $application;
    protected $pembimbing;
    protected $logbooks;
    protected $pengumuman;

    public function __construct()
    {
        $this->angkatan     = new \App\Models\AngkatanModel();
        $this->jurusan      = new \App\Models\JurusanModel();
        $this->user         = new \App\Models\UserModel();
        $this->siswa        = new \App\Models\SiswaModel();
        $this->tempat       = new \App\Models\TempatModel();
        $this->application  = new \App\Models\ApplicationModel();
        $this->pembimbing   = new \App\Models\PembimbingModel();
        $this->logbooks     = new \App\Models\LogBookModel();
        $this->pengumuman   = new \App\Models\PengumumanModel();
    }

    public function index()
    {
        $pengumuman = $this->pengumuman->select('pengumuman.*, pembimbing.nama as pembimbing')
            ->join('pembimbing', 'pembimbing.id = pengumuman.oleh')
            ->orderBy('pengumuman.created_at', "DESC")
            ->findAll();

        return view('dashboard', [
            "title"         => "Magang | Dashboard",
            "page_title"    => in_groups('admin') ? 'Dashboard Admin' : (in_groups('pembimbing') ? 'Dashboard Pembimbing' : 'Dashboard Siswa'),
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => in_groups('admin') ? ['Dashboard', 'Admin'] : (in_groups('pembimbing') ? ['Dashboard', 'Pembimbing'] : ['Dashboard', user()->username]),
            "siswa"         => $this->siswa->findAll(),
            "tempat"        => $this->tempat->findAll(),
            "tempat_buka"   => $this->tempat->where("status", 'buka')->countAllResults(),
            "tempat_tutup"  => $this->tempat->where("status", 'tutup')->countAllResults(),
            "pengumuman"    => $pengumuman
        ]);
    }

    public function tempat()
    {
        $tempat = $this->tempat->select('tempat_magang.*, pembimbing.nama as pembimbing')
            ->join('pembimbing', 'pembimbing.id = tempat_magang.pid')
            ->orderBy('tempat_magang.status', "ASC")
            ->findAll();

        return view('tempat', [
            "title"         => "Magang | Tempat Magang",
            "page_title"    => "Daftar Tempat Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Tempat Magang'],
            "tempat"        => $tempat
        ]);
    }

    public function nilai()
    {
        return view('nilai', [
            "title"         => "Magang | Nilai Siswa",
            "page_title"    => "Nilai Magang Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Nilai']
        ]);
    }

    public function daftarHadir($id = null)
    {
        $tempat = $this->application->select('lamaran.id_siswa as sid, tempat_magang.nama as instansi, tempat_magang.id as tid, tempat_magang.pid, tempat_magang.alamat, tempat_magang.hp, tempat_magang.email')
            ->join('tempat_magang', 'tempat_magang.id = lamaran.id_tempat')
            ->where('lamaran.id_siswa', getSid(user_id()))
            ->orderBy('lamaran.created_at', "DESC")
            ->first();

        $data = [
            "title"         => "Magang | Daftar Hadir Siswa",
            "page_title"    => "Daftar Hadir Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Daftar Hadir', user()->username],
            "tempat"        => $tempat,
            "logbooks"      => $this->logbooks->select('*')->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where('id_siswa', getSid(user_id()))->findAll()
        ];

        if ($id && is_numeric($id)) {
            $edit_logbook = $this->logbooks->select('*')->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where('id_siswa', getSid(user_id()))->where('id', $id)->first();

            if ($edit_logbook->status !== 'rejected') {
                return redirect()->to('/kehadiran');
            }

            $data['edit_logbook'] = $edit_logbook;
        }

        return view('kehadiran', $data);
    }

    public function application()
    {
        if (in_groups('admin')) {
            $dapp = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun')
                ->join('siswa', 'siswa.id = lamaran.id_siswa')
                ->join('angkatan', 'angkatan.id = siswa.angkatan')
                ->orderBy('lamaran.created_at', "DESC")
                ->findAll();
        } elseif (in_groups('siswa')) {
            $dapp = $this->application->select('lamaran.*, siswa.nama, siswa.nis, angkatan.tahun, tempat_magang.nama as instansi, tempat_magang.alamat')
                ->join('siswa', 'siswa.id = lamaran.id_siswa')
                ->join('angkatan', 'angkatan.id = siswa.angkatan')
                ->join('tempat_magang', 'tempat_magang.id = lamaran.id_tempat')
                ->where('lamaran.id_siswa', getSid(user_id()))
                ->orderBy('lamaran.created_at', "DESC")
                ->findAll();
        } else {
            // return note enaugth permission
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('application', [
            "title"         => "Magang | Application Siswa",
            "page_title"    => "Lamaran Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Application', user()->username],
            "applications"  => $dapp
        ]);
    }

    public function logbooks($idt)
    {
        $tempat = $this->tempat->find($idt);
        $siswa = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where('lamaran.id_tempat', $idt)
            ->where('lamaran.status', 'accepted')
            ->findAll();

        return view('logbook', [
            "title"         => "Magang | logbook Siswa",
            "page_title"    => "logbook Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['logbook', user()->username, $tempat->nama],
            "siswa"         => $siswa,
            "idt"           => $idt,
        ]);
    }

    public function logbook_siswa($idt, $nis)
    {
        $nis = substr($nis, 0, 2) . '.' . substr($nis, 2);
        $tempat = $this->tempat->find($idt);
        $siswa = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where('lamaran.id_tempat', $idt)
            ->where('lamaran.status', 'accepted')
            ->findAll();

        $log = $this->logbooks->select("*")->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where(['id_siswa' => $this->siswa->where('nis', $nis)->first()->id, 'id_pembimbing' => user_id()])->findAll();

        return view('logbook_siswa', [
            "title"         => "Magang | logbook Siswa",
            "page_title"    => "logbook Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['logbook', user()->username, $tempat->nama, $nis],
            "selected"      => $this->siswa->where('nis', $nis)->first(),
            "siswa"         => $siswa,
            "idt"           => $idt,
            "logbooks"      => $log
        ]);
    }

    public function man_tempat()
    {
        $tempat = $this->tempat->select('tempat_magang.*, pembimbing.nama as pembimbing')
            ->join('pembimbing', 'pembimbing.id = tempat_magang.pid')
            ->findAll();


        return view('man_tempat', [
            "title"         => "Magang | Manajemen Tempat",
            "page_title"    => "Manejemen Tempat Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Tempat'],
            "tempat"        => $tempat,
            "pembimbing"    => $this->pembimbing->findAll()
        ]);
    }

    public function tempat_edit($id)
    {
        return view('edit_tempat', [
            'title'         => 'Magang | Edit Tempat Magang',
            'page_title'    => 'Edit Tempat Magang',
            'segment'       => $this->request->getUri()->getSegments(),
            'breadcrumb'    => ['Manajemen', 'Tempat', 'Edit'],
            'tempat'        => $this->tempat->find($id),
            'pembimbing'    => $this->pembimbing->findAll()
        ]);
    }

    public function man_user()
    {
        $duser = $this->user
            ->select('users.id, users.username, users.email')
            ->select('pembimbing.id as pid, pembimbing.nama, pembimbing.no_hp')
            ->join('pembimbing', 'pembimbing.user_id = users.id')
            ->findAll();

        return view('man_user', [
            "title"         => "Magang | Manajemen User",
            "page_title"    => "Manajejemen Data Pengelola dan Guru",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'User'],
            "user"          => $duser
        ]);
    }

    public function man_siswa()
    {
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->findAll();

        return view('man_siswa', [
            "title"         => "Magang | Manajemen Siswa",
            "page_title"    => "Manajemen Data Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Siswa'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "siswa"         => $dsiswa
        ]);
    }

    public function siswa_edit($nis)
    {
        $nis = substr($nis, 0, 2) . '.' . substr($nis, 2);
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->where('siswa.nis', $nis)
            ->first();

        return view('edit_siswa', [
            "title"         => "Magang | Edit Data siswa",
            "page_title"    => "Edit Data Siswa $nis",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Siswa', 'Edit', $nis],
            "siswa"         => $dsiswa,
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll()
        ]);
    }

    public function settings()
    {
        return view('settings', [
            "title"         => "Magang | Site Settings",
            "page_title"    => "Pengaturan",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Settings'],
            "angkatan"      => $this->angkatan->orderBy('tahun', 'DESC')->findAll(),
            "jurusan"       => $this->jurusan->findAll()
        ]);
    }
}
