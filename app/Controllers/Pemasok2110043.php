<?php

namespace App\Controllers;

use App\Models\Mpemasok2110043;

class pemasok2110043 extends baseController
{
    private $varbarang;
    public function __construct()
    {
        $this->varbarang = new Mpemasok2110043();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolpemasok');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('caripemasok');
            session()->set('caripemasok', $cari);
            redirect()->to('/pemasok2110043/index');
        } else {
            $cari = session()->get('caripemasok');
        }
        $databarang = $cari ? $this->varbarang->caridata($cari) : $this->varbarang;
        $nohalaman = $this->request->getVar('page_barang') ? $this->request->getvar('page_barang') : 1;
        $data = [
            'databarang' => $databarang->paginate(10, 'pelanggan'),
            'pager' => $this->varbarang->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('pemasok2110043/vpemasok2110043', $data);
    }
    public function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getpost('aksi');
            $msg = [
                'data' => view('pemasok2110043/modalformpemasok2110043', ['aksi' => $aksi])
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa di ambil$ambildatakan');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $koderp = $this->request->getVar('koder');
            $namarp = $this->request->getVar('namar');
            $satuanrp = $this->request->getVar('satuanr');
            $hargarp = $this->request->getVar('hargar');

            $this->varbarang->insert([
                'kdpem2110043' => $koderp,
                'namapem2110043' => $namarp,
                'alamatpem2110043' => $satuanrp,
                'notlp2110043' => $hargarp,
            ]);
            $msg = [
                'sukses' => 'pemasok Berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }
    function hapus()
    {
        if ($this->request->isAJAX()) {
            $koder = $this->request->getVar('kdpem2110043');

            $this->varbarang->delete($koder);

            $msg = [
                'sukses' => 'pemasok Berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formedit()
    {
        if ($this->request->isAJAX()) {
            $koder = $this->request->getpost('koder');
            $ambildata = $this->varbarang->find($koder);
            $data = [
                'koder' => $koder,
                'namar' => $ambildata['namapem2110043'],
                'satuanr' => $ambildata['alamatpem2110043'],
                'hargar' => $ambildata['notlp2110043'],

            ];
            $msg = [
                'data' => view('pemasok2110043/modalformeditpemasok2110043', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $koderp = $this->request->getVar('kdpem2110043');
            $namarp = $this->request->getVar('namapem2110043');
            $satuanrp = $this->request->getVar('alamatpem2110043');
            $hargarp = $this->request->getVar('notlp2110043');

            $this->varbarang->update($koderp, [
                'namapem2110043' => $namarp,
                'alamatpem2110043' => $satuanrp,
                'notlp2110043' => $hargarp,

            ]);
            $msg = [
                'sukses' => 'Data pelanggan berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}
