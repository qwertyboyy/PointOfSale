<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpemasok2110043 extends Model
{
    protected $table = 'pemasok2110043';
    protected $primaryKey = 'kdpem2110043';
    protected $allowedFields = ['kdpem2110043', 'namapem2110043', 'alamatpem2110043', 'notlp2110043'];

    public function caridata($cari)
    {
        return $this->table('pemasok2110043')->like('namapem2110043', $cari);
    }
}
