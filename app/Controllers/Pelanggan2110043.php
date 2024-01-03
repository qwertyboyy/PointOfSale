<?php

namespace App\Controllers;

use App\Models\Mpelanggan2110043;

class pelanggan2110043 extends baseController
{
    private $pelanggan;
    public function __construct()
    {
        $this->pelanggan = new Mpelanggan2110043();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolpelanggan');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('caripelanggan');
            session()->set('caripelanggan', $cari);
            redirect()->to('/pelanggan2110043/index');
        } else {
            $cari = session()->get('caripelanggan');
        }
        $databarang = $cari ? $this->pelanggan->caridata($cari) : $this->pelanggan;
        $nohalaman = $this->request->getVar('page_barang') ? $this->request->getvar('page_barang') : 1;
        $data = [
            'databarang' => $databarang->paginate(10, 'pelanggan'),
            'pager' => $this->pelanggan->pager,
            'nohalaman' => $nohalaman,
            'cari' => $cari
        ];
        return view('pelanggan2110043/vpelanggan2110043', $data);
    }
    public function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getpost('aksi');
            $msg = [
                'data' => view('pelanggan2110043/modalformpelanggan2110043', ['aksi' => $aksi])
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

            $this->pelanggan->insert([
                'kdplg2110043' => $koderp,
                'namaplg2110043' => $namarp,
                'alamatplg2110043' => $satuanrp,
                'notlp2110043' => $hargarp,


            ]);
            $msg = [
                'sukses' => 'pelanggan Berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }
    function hapus()
    {
        if ($this->request->isAJAX()) {
            $koder = $this->request->getVar('kdplg2110043');

            $this->pelanggan->delete($koder);

            $msg = [
                'sukses' => 'pelanggan Berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formedit()
    {
        if ($this->request->isAJAX()) {
            $koder = $this->request->getpost('koder');
            $ambildata = $this->pelanggan->find($koder);
            $data = [
                'koder' => $koder,
                'namar' => $ambildata['namaplg2110043'],
                'satuanr' => $ambildata['alamatplg2110043'],
                'hargar' => $ambildata['notlp2110043'],

            ];
            $msg = [
                'data' => view('pelanggan2110043/modalformeditpelanggan2110043', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $koderp = $this->request->getVar('kdplg2110043');
            $namarp = $this->request->getVar('namaplg2110043');
            $satuanrp = $this->request->getVar('alamatplg2110043');
            $hargarp = $this->request->getVar('notlp2110043');

            $this->pelanggan->update($koderp, [
                'namaplg2110043' => $namarp,
                'alamatplg2110043' => $satuanrp,
                'notlp2110043' => $hargarp,

            ]);
            $msg = [
                'sukses' => 'Data pelanggan berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}
