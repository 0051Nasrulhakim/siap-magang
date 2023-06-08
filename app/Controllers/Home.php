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
    protected $nilai;

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
        $this->nilai        = new \App\Models\NilaiModel();
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

    public function profile()
    {
        return view('profile', [
            "title"         => "Magang | Profile",
            "page_title"    => in_groups('admin') ? 'Profile Admin' : (in_groups('pembimbing') ? 'Profile Pembimbing' : 'Profile Siswa'),
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => in_groups('admin') ? ['Profile', 'Admin'] : (in_groups('pembimbing') ? ['Profile', 'Pembimbing'] : ['Profile', user()->username]),
            "jurusan"       => $this->jurusan->findAll(),
            "angkatan"      => $this->angkatan->findAll(),
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
        // siswa and angkatan
        $dataSiswa = $this->siswa->select('siswa.*, angkatan.nama as angkatan, angkatan.tahun, angkatan.tgl_selesai')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where('siswa.id', getSidByUid(user_id()))
            ->first();

        return view('nilai', [
            "title"         => "Magang | Nilai Siswa",
            "page_title"    => "Nilai Magang Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Nilai'],
            "nilai"         => $this->nilai->where('ids', getSidByUid(user_id()))->first(),
            "siswa"         => $dataSiswa
        ]);
    }

    public function daftarHadir($id = null)
    {
        $tempat = $this->application->select('lamaran.id_siswa as sid, tempat_magang.nama as instansi, tempat_magang.id as tid, tempat_magang.pid, tempat_magang.alamat, tempat_magang.hp, tempat_magang.email')
            ->join('tempat_magang', 'tempat_magang.id = lamaran.id_tempat')
            ->where('lamaran.id_siswa', getSidByUid(user_id()))
            ->orderBy('lamaran.created_at', "DESC")
            ->first();

        $data = [
            "title"         => "Magang | Daftar Hadir Siswa",
            "page_title"    => "Daftar Hadir Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Daftar Hadir', user()->username],
            "tempat"        => $tempat,
            "logbooks"      => $this->logbooks->select('*')->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where('id_siswa', getSidByUid(user_id()))->findAll()
        ];

        if ($id && is_numeric($id)) {
            $edit_logbook = $this->logbooks->select('*')->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where('id_siswa', getSidByUid(user_id()))->where('id', $id)->first();

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
            $dapp = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.laporan, siswa.alamat, angkatan.tahun, angkatan.tgl_selesai')
                ->join('siswa', 'siswa.id = lamaran.id_siswa')
                ->join('angkatan', 'angkatan.id = siswa.angkatan')
                ->orderBy('lamaran.created_at', "DESC")
                ->findAll();
        } elseif (in_groups('siswa')) {
            $dapp = $this->application->select('lamaran.*, siswa.nama, siswa.nis, siswa.laporan, angkatan.tahun, angkatan.tgl_selesai, tempat_magang.nama as instansi, tempat_magang.alamat, pembimbing.nama as nama_pembimbing, pembimbing.no_hp as hp_pembimbing, pembimbing.email as email_pembimbing')
                ->join('siswa', 'siswa.id = lamaran.id_siswa')
                ->join('angkatan', 'angkatan.id = siswa.angkatan')
                ->join('tempat_magang', 'tempat_magang.id = lamaran.id_tempat')
                ->join('pembimbing', 'pembimbing.id = tempat_magang.pid')
                ->where('lamaran.id_siswa', getSidByUid(user_id()))
                ->orderBy('lamaran.created_at', "DESC")
                ->findAll();
        } else {
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
        $siswas = $this->application->select('lamaran.*, siswa.id as sid, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where(['lamaran.id_tempat' => $idt])
            ->whereIn('lamaran.status', ['accepted', 'selesai'])
            ->orderBy('lamaran.created_at', "DESC")
            ->findAll();

        return view('logbook', [
            "title"         => "Magang | logbook Siswa",
            "page_title"    => "logbook Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['logbook', user()->username, $tempat->nama],
            "siswas"         => $siswas,
            "idt"           => $idt,
        ]);
    }

    public function logbook_siswa($idt, $nis)
    {
        $tempat = $this->tempat->find($idt);
        $siswas = $this->application->select('lamaran.*, siswa.id as sid, siswa.nama, siswa.nis, siswa.kelas, siswa.no_hp, siswa.alamat, siswa.laporan, angkatan.tahun')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where(['lamaran.id_tempat' => $idt])
            ->whereIn('lamaran.status', ['accepted', 'selesai'])
            ->orderBy('lamaran.created_at', "DESC")
            ->findAll();

        $siswa = $this->siswa
            ->select('siswa.*, angkatan.nama as angkatan, angkatan.tahun, angkatan.tgl_selesai')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where('nis', $nis)
            ->first();

        $log = $this->logbooks->select("*")->select("IF(DATE(created_at) > tanggal, true, false) as telat", false)->where(['id_siswa' => $this->siswa->where('nis', $nis)->first()->id, 'id_pembimbing' => user_id()])->findAll();

        return view('logbook_siswa', [
            "title"         => "Magang | logbook Siswa",
            "page_title"    => "logbook Siswa Magang",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['logbook', user()->username, $tempat->nama, $nis],
            "selected"      => $this->siswa->where('nis', $nis)->first(),
            "siswas"        => $siswas,
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
        $pem = $this->pembimbing->findAll();
        $pem = array_map(function ($p) {
            return [
                'value' => $p->nama,
                'label' => $p->nama,
                'num'   => $p->id,
            ];
        }, $pem);

        return view('man_tempat', [
            "title"             => "Magang | Manajemen Tempat",
            "page_title"        => "Manejemen Tempat Magang",
            "segment"           => $this->request->getUri()->getSegments(),
            "breadcrumb"        => ['Manajemen', 'Tempat'],
            "tempat"            => $tempat,
            "pembimbing"        => $this->pembimbing->findAll(),
            "pembimbing_json"   => json_encode($pem)
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
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.nama as angkatan, angkatan.tahun')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->findAll();

        $angkatan_jeson = $this->angkatan->findAll();
        $angkatan_jeson = array_map(function ($item) {
            return [
                'value' => $item->nama . ' - ' . $item->tahun,
                'label' => $item->nama . ' - ' . $item->tahun,
                'no'    => $item->id,
                'tahun' => $item->tahun,
            ];
        }, $angkatan_jeson);

        return view('man_siswa', [
            "title"         => "Magang | Manajemen Siswa",
            "page_title"    => "Manajemen Data Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Siswa'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "siswa"         => $dsiswa,
            "angkatan_json" => json_encode($angkatan_jeson)
        ]);
    }

    public function siswa_edit($nis)
    {
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.nama as angkatan, angkatan.tahun, angkatan.id as num')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->where('siswa.nis', $nis)
            ->first();

        $angkatan_jeson = $this->angkatan->findAll();
        $angkatan_jeson = array_map(function ($item) {
            return [
                'value' => $item->nama . ' - ' . $item->tahun,
                'label' => $item->nama . ' - ' . $item->tahun,
                'no'    => $item->id,
                'tahun' => $item->tahun,
            ];
        }, $angkatan_jeson);

        return view('siswa_edit', [
            "title"         => "Magang | Edit Data siswa",
            "page_title"    => "Edit Data Siswa $nis",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Siswa', 'Edit', $nis],
            "siswa"         => $dsiswa,
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "angkatan_json" => json_encode($angkatan_jeson)
        ]);
    }

    public function laporan()
    {
        return view('laporan_all', [
            "title"         => "Magang | Site Settings",
            "page_title"    => "Pengaturan",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Settings'],
            "jurusan"       => $this->jurusan->orderBy('nama_jurusan', 'ASC')->findAll(),
            "angkatan"      => $this->angkatan->orderBy('tahun', 'DESC')->findAll(),
            "tahun"         => $this->angkatan->orderBy('tahun', 'DESC')->groupBy('tahun')->findAll(),
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
