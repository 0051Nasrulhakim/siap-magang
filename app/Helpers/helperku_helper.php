<?php 
    function badgeStatusApplication($s)
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
            default:
                return '<span class="badge badge-secondary border border-secondary">Unknown</span>';
                break;
        }
    }

    function badgeKehadiran($k)
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

    function getInstansi($id_tempat)
    {
        $ins = new \App\Models\TempatModel();
        $data = $ins->find($id_tempat);
        return $data->nama;
    }

    function genIconInstansi($id_tempat){
        if ($id_tempat == null) {
            return '<i class="fas text-warning me-2 fa-info-circle" title="Tempat pengajuan sendiri (belum terverifikasi sekolah)" style="cursor:help;"></i>';
        } else {
            return '<i class="far text-success me-2 fa-check-circle" title="Tempat sudah terverifikasi sekolah" style="cursor:help;"></i>';
        }
    }

    // getSiswaIdByUserId
    function getSid($uid)
    {
        $siswa = new \App\Models\SiswaModel();
        $data = $siswa->where('user_id', $uid)->first();
        return $data->id;
    }

    function getInstansiByPembimbingId($id_pembimbing)
    {
        $ins = new \App\Models\TempatModel();
        $data = $ins->select('tempat_magang.*',)
            ->select('lamaran.id_tempat', 'lamaran.id_siswa', 'lamaran.status as status_lamaran')
            ->join('lamaran', 'lamaran.id_tempat = tempat_magang.id')
            ->where(['tempat_magang.pid' => $id_pembimbing, 'tempat_magang.status' => 'buka'])
            ->where('lamaran.status', 'accepted')
            ->groupBy('tempat_magang.id')
            ->findAll();
        return $data;
    }

    function getApplicationSiswa($uid)
    {
        $app = new \App\Models\ApplicationModel();
        $data = $app->where(['id_siswa' => $uid, 'status' => 'accepted'])->orderBy('created_at', 'DESC')->findAll();
        return $data;
    }