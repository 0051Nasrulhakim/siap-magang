<?php
if (!function_exists('initCheck')) {
    function initCheck($uid, $tid)
    {
        $sid = getSidByUid($uid);
        $ready = null;

        if (
            empty(getApplicationSiswa($sid)) &&
            getSlotAvailable($tid) !== 0 &&
            isSiswaActive($sid)
        ) {
            $ready = true;
        } else {
            $ready = false;
        }

        return $ready;
    }
}

if (!function_exists('isSiswaActive')) {
    function isSiswaActive($sid)
    {
        $siswa = new \App\Models\SiswaModel();
        $data = $siswa->select('siswa.*, angkatan.tahun, angkatan.nama as angkatan, angkatan.tgl_mulai, angkatan.tgl_selesai')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->where('siswa.id', $sid)
            ->first();

        $now = date('Y-m-d');
        $tgl_mulai = $data->tgl_mulai;
        $tgl_selesai = $data->tgl_selesai;

        if ($now >= $tgl_mulai && $now <= $tgl_selesai) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists("checkNowAndPeroid")) {
    function checkNowAndPeroid()
    {
        $now = date('Y-m-d');
        $application = new \App\Models\ApplicationModel();
        $application_data = $application->select('lamaran.*, siswa.angkatan, angkatan.tahun, angkatan.nama as angkatan, angkatan.tgl_mulai, angkatan.tgl_selesai')
            ->join('siswa', 'siswa.id = lamaran.id_siswa')
            ->join('angkatan', 'angkatan.id = siswa.angkatan')
            ->findAll();

        foreach ($application_data as $ad) {
            if ($now > $ad->tgl_selesai && $ad->status == 'accepted') {
                $application->update($ad->id, ['status' => 'selesai']);
            }
        }
    }
}

if (!function_exists('getSiswaData')) {
    function getSiswaData($id)
    {
        $siswa = new \App\Models\SiswaModel();
        $data = $siswa->where('user_id', $id)->select('siswa.*, users.username, users.email as uemail, users.created_at')
            ->join('users', 'users.id = siswa.user_id')
            ->where('siswa.user_id', $id)->first();
        return $data;
    }
}

if (!function_exists('getPembimbingData')) {
    function getPembimbingData($id)
    {
        $pembimbing = new \App\Models\PembimbingModel();
        $data = $pembimbing->select('pembimbing.*, users.username, users.email as uemail, users.created_at')
            ->join('users', 'users.id = pembimbing.user_id')
            ->where('pembimbing.user_id', $id)->first();
        return $data;
    }
}


if (!function_exists('isLaporanUploaded')) {
    function isLaporanUploaded($sid)
    {
        $siswa = new \App\Models\SiswaModel();
        $data = $siswa->where('id', $sid)->first();
        if ($data->laporan == null) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('getNamaInstansi')) {
    function getNamaInstansi($id_tempat)
    {
        $ins = new \App\Models\TempatModel();
        $data = $ins->find($id_tempat);
        return $data->nama;
    }
}

if (!function_exists('isVerifiedInstansi')) {
    function isVerifiedInstansi($id_tempat)
    {
        if ($id_tempat == null) {
            return '<i class="fas text-warning me-2 fa-info-circle" title="Tempat pengajuan sendiri (belum terverifikasi sekolah)" style="cursor:help;"></i>';
        } else {
            return '<i class="far text-success me-2 fa-check-circle" title="Tempat sudah terverifikasi sekolah" style="cursor:help;"></i>';
        }
    }
}


if (!function_exists('genBadgeRoles')) {
    function genBadgeRoles($r)
    {
        switch (strtolower($r)) {
            case 'admin':
                return '<span class="badge badge-success border border-success">Admin</span>';
                break;
            case 'pembimbing':
                return '<span class="badge badge-info border border-info">Pembimbing</span>';
                break;
            case 'siswa':
                return '<span class="badge badge-warning border border-warning">Siswa</span>';
                break;
            default:
                return '<span class="badge badge-secondary border border-secondary">Unknown</span>';
                break;
        }
    }
}


if (!function_exists('genBadgeStatusApplication')) {
    function genBadgeStatusApplication($s)
    {
        switch ($s) {
            case 'pending':
                return '<span class="badge badge-warning border border-warning">Pending</span>';
                break;
            case 'accepted':
                return '<span class="badge badge-success border border-success">Accepted</span>';
                break;
            case 'approved':
                return '<span class="badge badge-success border border-success">Approved</span>';
                break;
            case 'rejected':
                return '<span class="badge badge-danger border border-danger">Rejected</span>';
                break;
            case 'selesai':
                return '<span class="badge badge-info border border-info">Selesai</span>';
                break;
            case 'reject by system':
                return '<span class="badge badge-danger border border-danger">reject by system</span>';
                break;
            default:
                return '<span class="badge badge-secondary border border-secondary">Unknown</span>';
                break;
        }
    }
}


if (!function_exists('genBadgeKehadiran')) {
    function genBadgeKehadiran($k)
    {
        switch ($k) {
            case 'hadir':
                return '<span class="badge badge-success border border-success">Hadir</span>';
                break;
            case 'izin':
                return '<span class="badge badge-warning border border-warning">Izin</span>';
                break;
            case 'sakit':
                return '<span class="badge badge-info border border-info">Sakit</span>';
                break;
            case 'alfa':
                return '<span class="badge badge-danger border border-danger">Alfa</span>';
                break;
            default:
                return '<span class="badge badge-secondary">Unknown</span>';
                break;
        }
    }
}

if (!function_exists('getSidByUid')) {
    function getSidByUid($uid)
    {
        $siswa = new \App\Models\SiswaModel();
        $data = $siswa->where('user_id', $uid)->first();
        return $data->id;
    }
}

if (!function_exists('getPidByUid')) {
    function getPidByUid($uid)
    {
        $pembimbing = new \App\Models\PembimbingModel();
        $data = $pembimbing->where('user_id', $uid)->first();
        return $data->id;
    }
}

if (!function_exists('getInstansiByPid')) {
    function getInstansiByPid($uid)
    {
        $ins = new \App\Models\TempatModel();
        $idp = getPidByUid($uid);

        $data = $ins->select('tempat_magang.*',)
            ->select('lamaran.id_tempat', 'lamaran.id_siswa', 'lamaran.status as status_lamaran')
            ->join('lamaran', 'lamaran.id_tempat = tempat_magang.id')
            ->where(['tempat_magang.pid' => $idp, 'tempat_magang.status' => 'buka', 'lamaran.status' => 'accepted'])
            ->orWhere(['tempat_magang.pid' => $idp, 'tempat_magang.status' => 'buka', 'lamaran.status' => 'selesai'])
            ->groupBy('tempat_magang.id')
            ->findAll();
            
        return $data;
    }
}

if (!function_exists('isAccepted')) {
    function isAccepted($sid) {
        $app = new \App\Models\ApplicationModel();
        $data = $app->where(['id_siswa' => $sid, 'status' => 'accepted'])
            ->orderBy('created_at', 'DESC')
            ->findAll();
        return $data;
    }

}

if (!function_exists('getApplicationSiswa')) {
    function getApplicationSiswa($uid)
    {
        $app = new \App\Models\ApplicationModel();
        $data = $app->where(['id_siswa' => $uid, 'status' => 'accepted'])
            ->orWhere(['id_siswa' => $uid, 'status' => 'selesai'])
            ->orderBy('created_at', 'DESC')
            ->findAll();
        return $data;
    }
}

if (!function_exists('getNisByUid')) {
    function getNisByUid()
    {
        $siswa = new \App\Models\SiswaModel();
        return $siswa->where('user_id', user_id())->first()->nis;
    }
}

if (!function_exists('getSlotAvailable')) {
    function getSlotAvailable($tid)
    {
        $app = new \App\Models\ApplicationModel();
        $tempat = new \App\Models\TempatModel();

        $data = $app->where(['id_tempat' => $tid, 'status' => 'accepted'])->findAll();
        $tempat = $tempat->find($tid);

        return $tempat->kuota - count($data);
    }
}

if(!function_exists('getStatusSiswa')) {
    function getStatusSiswa($sid)
    {
        $app = new \App\Models\ApplicationModel();
        $data = $app->where(['id_siswa' => $sid])->first();
        return $data->status;
    }
}

if(!function_exists('nilaiAvailable')){
    function nilaiAvailable($sid)
    {
        $nilai = new \App\Models\NilaiModel();
        $data = $nilai->where(['ids' => $sid])->first();
        
        if($data == null){
            return false;
        }else{
            return true;
        }
    }
}

if(!function_exists('getNilaiSiswa')){
    function getNilaiSiswa($sid)
    {
        $nilai = new \App\Models\NilaiModel();
        $data = $nilai->where(['ids' => $sid])->first();
        return $data;
    }
}