<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbarang2110043 extends Model
{
    protected $table        = 'barang2110043';
    protected $primaryKey   = 'kdbrg2110043';
    protected $allowedFields    = ['kdbrg2110043', 'namabrg2110043', 'satuanbrg2110043', 'hargabrg2110043', 'stokbrg2110043'];

    public function cariData($cari)
    {
        return $this->table('barang2110043')->like('namabrg2110043', $cari);
    }
}
