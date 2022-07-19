<?php
 
namespace App\Controllers;

use App\Models\FamilyModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;


class Family extends ResourceController
{
    
    private $ses_data;
    private $db;

    use ResponseTrait;

    private function checkToken()
    {

        $this->db=db_connect();
        $builder=$this->db->table('data_user');
        $array = ['TOKEN_API =' => $this->request->getVar('token')]; 
        $builder->where($array);
        $query=$builder->get();
        $data=$query->getResult();

        foreach ($data as $row){
            $this->ses_data = [
                'user_name'     => $row->KD_USER,
                'nama_lengkap'  => $row->NM_USER,
                'level'         => $row->LEVEL,
                'token'         => $row->TOKEN_API,
                'date_create'   => $row->DATE_TOKEN_CREATE,
                'logged_in'     => TRUE
            ];
        }
        $this->db->close();

        if ($this->request->getVar('token')=='') {
            
            $user = $this->request->getVar('username');
            $pass = $this->request->getVar('password');

            $this->db=db_connect();
            $builder=$this->db->table('data_user');
            if ($user=='' && $pass=''){
                $data=[
                    'TOKEN_API'    => '',
                ];
            }else{
                $data=[
                    'TOKEN_API'    => bin2hex(\CodeIgniter\Encryption\Encryption::createKey(40)),
                    'DATE_TOKEN_CREATE' => date('Y-m-d H:i:s'),
                ];
            }
            
            $array = ['KD_USER =' => $user,'PWD =' => sha1($pass)]; 
            $builder->where($array);
            $builder->update($data);

            //setelah buat token, baca kembali berdasarkan token
            $builder=$this->db->table('data_user');
            $array = ['TOKEN_API =' => $data['TOKEN_API']]; 
            $builder->where($array);
            $query=$builder->get();
            $data=$query->getResult();
            
            foreach ($data as $row){
                $this->ses_data = [
                    'user_name'     => $row->KD_USER,
                    'nama_lengkap'  => $row->NM_USER,
                    'level'         => $row->LEVEL,
                    'token'         => $row->TOKEN_API,
                    'date_create'   => $row->DATE_TOKEN_CREATE,
                    'logged_in'     => TRUE
                ];
            }
            $this->db->close();
            return $this->ses_data['token'];
        }else{
            return $this->ses_data['token'];
        }
    }

    // all users
    public function index()
    {
        if ($this->checkToken()=='') {
            return $this->failUnauthorized('Login Required');
        }else{
            $model = new FamilyModel();
            // $data = $this->ses_data;
            $data['family'] = $model->orderBy('id', 'ASC')->findAll();
            return $this->respond($data);
        }
    }

    // single user
    public function show($id = null)
    {
        if ($id == 'login'){
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Failed');
            }else{
                $model = new FamilyModel();
                $data = $this->ses_data;
                return $this->respond($data);
            }
        }else{
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Required');
            }else{
    
                $model = new FamilyModel();
                $data = $model->where('id', $id)->first();
                if ($data) {
                    return $this->respond($data);
                } else {
                    return $this->failNotFound('Data tidak ditemukan');
                }
            }
        }
        
    }

    // create
    public function create()
    {
        if ($this->checkToken()=='') {
            return $this->failUnauthorized('Login Required');
        }else{
            $model = new FamilyModel();
            $data = [
                'NAMA_LENGKAP' => $this->request->getVar('namalengkap'),
                'TGL_LAHIR'  => $this->request->getVar('tgllahir'),
                'STATUS' => $this->request->getVar('status'),
                'KD_USER'  => $this->request->getVar('user'),
            ];
            $model->insert($data);
            return $this->respondCreated('Data berhasil ditambahkan');
        }
    }

    // update
    public function update($id = null)
    {
        if ($this->checkToken()=='') {
            return $this->failUnauthorized('Login Required');
        }else{
            $model = new FamilyModel();
            $id = $this->request->getVar('id');
            $data = [
                'NAMA_LENGKAP' => $this->request->getVar('namalengkap'),
                'TGL_LAHIR'  => $this->request->getVar('tgllahir'),
                'STATUS' => $this->request->getVar('status'),
                'KD_USER'  => $this->request->getVar('user'),
            ];
            $model->update($id, $data);
            return $this->respondUpdated('Data berhasil diubah');
        }
    }

    // delete
    public function delete($id = null)
    {
        if ($this->checkToken()=='') {
            return $this->failUnauthorized('Login Required');
        }else{
            $model = new FamilyModel();
            $data = $model->where('id', $id)->delete($id);
            if ($data) {
                $model->delete($id);
                return $this->respondDeleted('Data berhasil dihapus');
            } else {
                return $this->failNotFound('Data tidak ditemukan');
            }
        }
    }
}
