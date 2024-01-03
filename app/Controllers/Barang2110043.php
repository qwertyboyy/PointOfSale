<?php

namespace App\Controllers;

use App\Models\Mbarang2110043;

class Barang2110043 extends BaseController
{
    private $barang;

    public function __construct()
    {
        $this->barang = new Mbarang2110043();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolbarang');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('caribarang');
            session()->set('caribarang', $cari);
            redirect()->to('/barang2110043/index');
        } else {
            $cari = session()->get('caribarang');
        }
        $databarang = $cari ? $this->barang->cariData($cari) : $this->barang;
        $noHalaman = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;
        $data = [
            'databarang' => $databarang->paginate(5, 'barang2110043'),
            'pager' => $this->barang->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('barang2110043/vbarang2110043', $data);
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('barang2110043/modalformtambah2110043', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdbrg = $this->request->getVar('kode');
            $namabrg = $this->request->getVar('nama');
            $satuanbrg = $this->request->getVar('satuan');
            $hargabrg = $this->request->getVar('harga');
            $stokbrg = $this->request->getVar('stok');

            $this->barang->insert([
                'kdbrg2110043' => $kdbrg,
                'namabrg2110043' => $namabrg,
                'satuanbrg2110043' => $satuanbrg,
                'hargabrg2110043' => $hargabrg,
                'stokbrg2110043' => $stokbrg
            ]);
            $msg = ['sukses' => 'Data Barang Berhasil ditambahkan'];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kdbrg2110043');

            $this->barang->delete($kode);
            $msg = ['sukses' => 'Data Barang Berhasil dihapus'];
            echo json_encode($msg);
        }
    }

    function FormEdit()
    {
        if ($this->request->isAJAX()) {
            $kdbrg = $this->request->getVar('kdbrg2110043');

            $ambildatabarang = $this->barang->find($kdbrg);
            $data = [
                'kdbrg' => $kdbrg,
                'namabrg' => $ambildatabarang['namabrg2110043'],
                'satuanbrg' => $ambildatabarang['satuanbrg2110043'],
                'hargabrg' => $ambildatabarang['hargabrg2110043'],
                'stokbrg' => $ambildatabarang['stokbrg2110043'],
            ];
            $msg = [
                'data' => view('barang2110043/formedit2110043', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $kdbrg = $this->request->getVar('kdbrg');
            $namabrg = $this->request->getVar('namabrg');
            $satuanbrg = $this->request->getVar('satuanbrg');
            $hargabrg = $this->request->getVar('hargabrg');
            $stokbrg = $this->request->getVar('stokbrg');

            $this->barang->update($kdbrg, [
                'namabrg2110043' => $namabrg,
                'satuanbrg2110043' => $satuanbrg,
                'hargabrg2110043' => $hargabrg,
                'stokbrg2110043' => $stokbrg
            ]);
            $msg = ['sukses' => 'Data Barang Berhasil diupdate'];
            echo json_encode($msg);
        }
    }
}
