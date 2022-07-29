<?php
 
namespace App\Controllers;

use App\Models\FamilyModel;
use App\Models\UserModel;
use App\Models\NewsModel;
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
            $data = $model->where('kd_user', $this->ses_data['user_name'])->findAll();
            return $this->respond($data);
        }
    }

    // single user
    public function show($id = null)
    {
        if ($id == 'login'){
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Required');
            }else{
                $model = new FamilyModel();
                $data = $this->ses_data;
                return $this->respond($data);
            }

        }elseif ($id == 'news'){
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Required');
            }else{
                $model = new NewsModel();
                $array = ['kategori =' => '1', 'aktif =' => 'y'];
                
                $data = $model->where($array);
                $data = $model->orderBy('PUBLISHDATE','desc')->findAll();
                return $this->respond($data);
            }

        }else{
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Required');
            }else{
    
                $model = new FamilyModel();
                $array = ['id =' => $id, 'kd_user =' => $this->ses_data['user_name']];
                $data = $model->where($array)->first();
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
        if ($this->request->getVar('register') == '1'){
            $model = new UserModel();
            $data = [
                'KD_USER' => $this->request->getVar('username'),
                'NM_USER'  => $this->request->getVar('namalengkap'),
                'PWD' => sha1($this->request->getVar('password')),
            ];
            $model->insert($data);
            return $this->respondCreated('Register berhasil');
        }else{
            if ($this->checkToken()=='') {
                return $this->failUnauthorized('Login Required');
            }else{
                $model = new FamilyModel();
                $data = [
                    'NAMA_LENGKAP' => $this->request->getVar('namalengkap'),
                    'TGL_LAHIR'  => $this->request->getVar('tgllahir'),
                    'STATUS' => $this->request->getVar('status'),
                    'KD_USER'  => $this->ses_data['user_name'],
                ];
                $model->insert($data);
                return $this->respondCreated('Data berhasil ditambahkan');
            }
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
                'KD_USER'  => $this->ses_data['user_name'],
            ];
            $array = ['id =' => $id, 'kd_user =' => $this->ses_data['user_name']];
            $model->where($array);
            $model->update($data);

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
            $array = ['id =' => $id, 'kd_user =' => $this->ses_data['user_name']];
            $data = $model->where($array)->delete();
            if ($data) {
                $model->where($array);
                $model->delete();
                return $this->respondDeleted('Data berhasil dihapus');
            } else {
                return $this->failNotFound('Data tidak ditemukan');
            }
        }
    }
}
