<?php

namespace App\Models;

use CodeIgniter\Model;

class TempatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tempat_magang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 5473;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 
        'pid', 'status', 'kuota', 'nama', 'hp', 'email', 'alamat', 'deskripsi', 'foto'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
