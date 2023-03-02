<?php

namespace App\Controllers;

class Home extends BaseController
{

    protected $kelas;
    protected $jurusan;

    public function __construct() {
        $this->kelas        = new \App\Models\KelasModel();
        $this->jurusan      = new \App\Models\JurusanModel();
    }

    public function index()
    {
        return view('admin/dashboard', [
            "title"         => "Magang | Dashboard",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['board']
        ]);
    }

    public function tempat()
    {
        return view('admin/tempat', [
            "title"         => "Magang | Tempat",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Tempat Magang']
        ]);
    }

    public function application()
    {
        return view('admin/application', [
            "title"         => "Magang | Application Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Application']
        ]);
    }

    public function man_tempat()
    {
        return view('admin/man_tempat', [
            "title"         => "Magang | Manajemen Tempat",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['manajemen', 'Tempat']
        ]);
    }

    public function man_user()
    {
        return view('admin/man_user', [
            "title"         => "Magang | Manajemen User",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['manajemen', 'User']
        ]);
    }

    public function man_siswa()
    {
        return view('admin/man_siswa', [
            "title"         => "Magang | Manajemen Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['manajemen', 'Siswa']
        ]);
    }

    public function settings()
    {
        return view('admin/settings', [
            "title"         => "Magang | Manajemen Kelas dan Jurusan",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['settings'],
            "kelas"         => $this->kelas->findAll(),
            "jurusan"       => $this->jurusan->findAll()
        ]);
    }
}
