<?php

namespace App\Models;

use CodeIgniter\Model;

class PembimbingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pembimbing';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 7589;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'user_id', 'nama', 'no_hp', 'email'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
