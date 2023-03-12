<?php 
    function bageStatusApplication($s)
    {
        switch ($s) {
            case 'pending':
                return '<span class="badge badge-warning">Pending</span>';
                break;
            case 'accepted':
                return '<span class="badge badge-success">Accepted</span>';
                break;
            case 'rejected':
                return '<span class="badge badge-danger">Rejected</span>';
                break;
            case 'selesai':
                return '<span class="badge badge-info">Selesai</span>';
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