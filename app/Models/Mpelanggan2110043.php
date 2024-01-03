<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpelanggan2110043 extends Model
{
    protected $table = 'pelanggan2110043';
    protected $primaryKey = 'kdplg2110043';
    protected $allowedFields = ['kdplg2110043', 'namaplg2110043', 'alamatplg2110043', 'notlp2110043'];

    public function caridata($cari)
    {
        return $this->table('pelanggan2110043')->like('namaplg2110043', $cari);
    }
}
