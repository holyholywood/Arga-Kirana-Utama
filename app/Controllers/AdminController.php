<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\TransaksiModel;

class AdminController extends BaseController
{
    protected $materialModel;
    protected $transaksiModel;
    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        $this->transaksiModel = new TransaksiModel();
    }
    public function index()
    {
        $material = $this->materialModel->findAll();
        $data = [
            'title' => 'Dashboard',
            'material' => $material,
            'page' => 'home'
        ];
        return view('AdminLayout/dashboard', $data);
    }


    public function addView()
    {
        session();
        $data = [
            'title' => 'Tambah data | Admin',
            'validation' => \Config\Services::validation(),
            'page' => 'add'
        ];
        return view('AdminLayout/InsertForm', $data);
    }



    public function save()
    {

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'InputMaterial' => 'required',
            'InputSatuan' => 'required',
            'InputBudget' => 'required',
            'InputReal' => 'required',
            'InputTglPembelian' => 'required'
        ]);

        if ($validation->withRequest($this->request)->run()) {
            //valid form
        } else {
            return redirect()->to('/add')->withInput();
        }


        // Insert DB
        $this->materialModel->save([
            'material' => $this->request->getVar('InputMaterial'),
            'jumlah' => $this->request->getVar('InputJumlah'),
            'satuan' => $this->request->getVar('InputSatuan'),
            'harga_budget' => $this->request->getVar('InputBudget'),
            'harga_real' => $this->request->getVar('InputReal'),
            'approval' => $this->request->getVar('InputApprove'),
            'status' => $this->request->getVar('InputStatus'),
            'tgl_beli' => $this->request->getVar('InputTglPembelian'),
            'keterangan' => $this->request->getVar('InputKeterangan'),

        ]);

        return redirect()->to('/');
    }
    public function delete()
    {
        $id = $this->request->getVar('id');
        $this->materialModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/dashboard');
    }

    public function edit($id)
    {
        session();
        $material = $this->materialModel->find($id);
        $data = [
            'title' => 'Edit data | Admin',
            'validation' => \Config\Services::validation(),
            'material' => $material,
            'page' => ''
        ];
        return view('AdminLayout/EditForm', $data);
    }

    // Proses Update
    public function update()
    {

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'InputMaterial' => 'required',
            'InputSatuan' => 'required',
            'InputBudget' => 'required',
            'InputReal' => 'required',
            'InputTglPembelian' => 'required'
        ]);

        if ($validation->withRequest($this->request)->run()) {
            //valid form
        } else {
            return redirect()->to('/admin/add')->withInput();
        }


        // Insert DB
        $this->materialModel->save([
            'id' => $this->request->getVar('id'),
            'material' => $this->request->getVar('InputMaterial'),
            'jumlah' => $this->request->getVar('InputJumlah'),
            'satuan' => $this->request->getVar('InputSatuan'),
            'harga_budget' => $this->request->getVar('InputBudget'),
            'harga_real' => $this->request->getVar('InputReal'),
            'approval' => $this->request->getVar('InputApprove'),
            'status' => $this->request->getVar('InputStatus'),
            'tgl_beli' => $this->request->getVar('InputTglPembelian'),
            'keterangan' => $this->request->getVar('InputKeterangan'),

        ]);

        return redirect()->to('/dashboard');
    }

    public function user()
    {
        $users =  new \Myth\Auth\Models\UserModel();

        $data['title'] = 'Kelola Pengguna';
        $data['page'] = '';
        $data['users'] = $users->findAll();

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();

        return view('AdminLayout/UserManagement', $data);
    }

    public function rekap()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->orderBy('tanggal', 'DESC');
        $builder->orderBy('id_transaksi', 'DESC');
        $query = $builder->get();


        $data = [
            'title' => 'Data Keluar - Masuk',
            'page' => 'rekap',
            'data' => $query->getResultArray(),
            'dataBytanggal' => null
        ];
        return view('AdminLayout/RecapView', $data);
    }

    public function rekaptanggal()
    {
        $tanggal = $this->request->getVar('inputtgl');
        //cari berdasarkan tanggal
        $dataBytanggal = $this->transaksiModel->asArray()->where('tanggal', $tanggal)->findAll();
        $data = [
            'title' => 'Data Keluar - Masuk',
            'page' => 'rekap',
            'data' => $dataBytanggal,
            'dataBytanggal' => $tanggal
        ];
        return view('AdminLayout/RecapView', $data);
    }



    public function materialkeluar()
    {
        $idmaterial = $this->request->getVar('id');
        $jumlahkeluar = $this->request->getvar('jumlah');
        $materialtemp = $this->materialModel->find($idmaterial);
        $material = $materialtemp['material'];
        $date = $this->request->getvar('InputTgl');
        $keterangan = $this->request->getvar('keterangan');


        if ($jumlahkeluar > $materialtemp['jumlah']) {
            session()->setFlashdata('pesan', 'Jumlah keluar tidak valid');
            return redirect()->to('/');
        }
        if ($date < $materialtemp['tgl_beli']) {
            session()->setFlashdata('pesan', 'Tanggal keluar tidak valid');
            return redirect()->to('/');
        }
        $jumlah = $materialtemp['jumlah'] - $jumlahkeluar;
        if ($materialtemp['jumlah'] == $jumlah) {
            return redirect()->to('/');
        }
        $this->transaksiModel->save([
            'tanggal' => $date,
            'idbarang' => $idmaterial,
            'keluar' => $jumlahkeluar,
            'namabarang' => $material,
            'tr_keterangan' => $keterangan,
            'stock' => $jumlah
        ]);


        $this->materialModel->save([
            'id' => $idmaterial,
            'jumlah' => $jumlah
        ]);
        return redirect()->to('/rekap');
    }
    public function materialmasuk()
    {
        $idmaterial = $this->request->getVar('id');
        $jumlahmasuk = $this->request->getvar('jumlah');
        $materialtemp = $this->materialModel->find($idmaterial);
        $material = $materialtemp['material'];
        $date = $this->request->getvar('InputTgl');
        $keterangan = $this->request->getvar('keterangan');

        $jumlah = $materialtemp['jumlah'] + $jumlahmasuk;
        if ($date < $materialtemp['tgl_beli']) {
            session()->setFlashdata('pesan', 'Tanggal masuk tidak valid');
            return redirect()->to('/');
        }
        if ($materialtemp['jumlah'] == $jumlah) {
            return redirect()->to('/');
        }
        $this->transaksiModel->save([
            'tanggal' => $date,
            'idbarang' => $idmaterial,
            'masuk' => $jumlahmasuk,
            'namabarang' => $material,
            'tr_keterangan' => $keterangan,
            'stock' => $jumlah
        ]);


        $this->materialModel->save([
            'id' => $idmaterial,
            'jumlah' => $jumlah
        ]);
        return redirect()->to('/rekap');
    }

    public function edittanggal()
    {
        $idtransaksi =  $this->request->getVar('id');
        $tanggal = $this->request->getvar('InputTgl');
        if ($tanggal) {
            $this->transaksiModel->save([
                'id_transaksi' => $idtransaksi,
                'tanggal' => $tanggal
            ]);
            session()->setFlashdata('pesan', 'Tanggal Berhasil Diganti');
            return redirect()->to('/rekap');
        }
        session()->setFlashdata('pesan', 'Tanggal tidak valid');
        return redirect()->to('/rekap');
    }
}
