<?php

namespace App\Models;

use CodeIgniter\Model;

class AngkatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'angkatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tahun', 'nama', 'tgl_mulai', 'tgl_selesai'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
