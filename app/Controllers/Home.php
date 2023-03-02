<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/dashboard', [
            "title" => "Magang | Dashboard"
        ]);
    }

    public function tempat()
    {
        return view('admin/tempat', [
            "title" => "Magang | Tempat"
        ]);
    }

    public function application()
    {
        return view('admin/application', [
            "title" => "Magang | Application Siswa"
        ]);
    }

    public function man_tempat()
    {
        return view('admin/man_tempat', [
            "title" => "Magang | Manajemen Tempat"
        ]);
    }

    public function man_user()
    {
        return view('admin/man_user', [
            "title" => "Magang | Manajemen User"
        ]);
    }

    public function man_siswa()
    {
        return view('admin/man_siswa', [
            "title" => "Magang | Manajemen Siswa"
        ]);
    }
}
