<?php

namespace App\Models;

use CodeIgniter\Model;

class LogBookModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'logbooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 4732;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_siswa', 'id_tempat', 'id_pembimbing', 'tanggal', 'jam_masuk', 'jam_keluar', 'keterangan', 'kegiatan', 'status', 'bukti'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
