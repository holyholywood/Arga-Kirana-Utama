<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $dateFormat = 'date';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'tanggal',
        'idbarang',
        'namabarang',
        'masuk',
        'keluar',
        'stock',
        'status',
        'tr_keterangan'
    ];
}
