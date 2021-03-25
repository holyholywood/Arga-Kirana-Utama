<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use Error;
use ErrorException;

class kelolapengguna extends BaseController
{
    // Login Check

    public function index()
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
    public function makeadmin()
    {
        $id = $this->request->getVar('userid');
        $db = \Config\Database::connect();
        $builder = $db->table('auth_groups_users');
        $dataadd = [
            'group_id' => 1,
            'user_id'  => $id,
        ];

        $builder->insert($dataadd);
        //delete sebagai pegawai
        $builder->delete([
            'group_id' => 2,
            'user_id' => $id,
        ]);
        return redirect()->to('/kelolapengguna');
    }
    public function deleteuser()
    {
        $id = $this->request->getVar('userid');
        // if (user()->getRoles()[2]) {
        //     return "dont have permission";
        // }
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->delete(['id' => $id]);
        return redirect()->to('/kelolapengguna');
    }









    public function cek()
    {
        dd(user()->__get('id'));
    }
}
