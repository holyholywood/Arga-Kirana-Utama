<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'materialdata';
    protected $dateFormat = 'date';
    protected $useTimestamps = true;
    // protected $createdField = 'tgl_beli';
    protected $useSoftDeletes = true;
    protected $updatedField = 'tgl_ubah';
    protected $allowedFields = [
        'material',
        'jumlah',
        'satuan',
        'harga_budget',
        'harga_real',
        'approval',
        'status',
        'tgl_beli',
        'keterangan'

    ];
}
