<?php

namespace App\Controllers;
use TheSeer\Tokenizer\Exception;
class Home extends BaseController
{
    public $db;
    public $id;
    protected $datalogin;

    public function __construct()
    {
        // $this->db=db_connect();
        // $builder=$this->db->table('data_keluarga');
    }
    public function index()
    {
        
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            echo view('login');
        }else{
            //return view('welcome_message');
            echo view('header');
        }
    }

    public function prosesData()
    {
        try {
            $this->db=db_connect();
            $builder=$this->db->table('data_keluarga');

            if(($this->request->getPost('InputAction'))=='save'){
                $builder->insert([
                    'nama_lengkap'    => $this->request->getPost('InputNama'),
                    'status'   => $this->request->getPost('InputStatus'),
                    'tgl_lahir' => $this->request->getPost('InputTanggal'),
                    'kd_user' => session()->get('user_name'),
                ]);
                
                $this->db->close();
                return redirect()->to('/data'); 

            }elseif(($this->request->getPost('InputAction'))=='edit'){
                $id=$this->request->getPost('ID');
                $data=[
                    'nama_lengkap'    => $this->request->getPost('InputNama'),
                    'status'   => $this->request->getPost('InputStatus'),
                    'tgl_lahir' => $this->request->getPost('InputTanggal'),
                    'kd_user' => session()->get('user_name'),
                ];
                $builder->where('id',$id);
                $builder->update($data);

                $this->db->close();
                return redirect()->to('/data'); 

            }elseif(($this->request->getPost('InputAction'))=='delete'){
                $id=$this->request->getPost('ID');
                $builder->where('id',$id);
                $builder->delete();

                $this->db->close();
                return redirect()->to('/data'); 

            }elseif(($this->request->getPost('InputAction'))=='delete_f'){
                $id=$this->request->getPost('ID');
                $builder->where('id',$id);
                $builder->delete();

                $this->db->close();

            }else{

                $this->db->close();
                return redirect()->to('/data');
                // return redirect()->back(); 
            }
            
            // return redirect()->route('/');
            // return redirect()->to('/');
            
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function prosesLogin()
    {
        try {
            $this->db=db_connect();
            $builder=$this->db->table('data_user');
            $array = ['KD_USER =' => $this->request->getPost('InputUsername'), 'PWD =' => $this->request->getPost('InputPassword'), 'STATUS =' => "1"];
            $builder->where($array);
            $query=$builder->get();
            $data=$query->getResult();

            $ses_data = [
                'user_name'     => '',
                'nama_lengkap'  => '',
                'level'         => '',
                'logged_in'     => FALSE
            ];

            foreach ($data as $row){
                $ses_data = [
                    'user_name'     => $row->KD_USER,
                    'nama_lengkap'  => $row->NM_USER,
                    'level'         => $row->LEVEL,
                    'logged_in'     => TRUE
                ];
            }

            $this->db->close();
            $session = session();
            $session->set($ses_data);

            if(! session()->get('logged_in')){
                // maka redirct ke halaman login
                echo '<script>alert("Username and Password not match!");</script>';
                echo view('login'); 
            }else{
                
                // return redirect()->to('/');
                echo '<script>alert("Login success!");</script>';
                echo view('header');
            }
            
            
        } catch (\Exception $e) {
            // return redirect()->to('/');
            die($e->getMessage());
        }
    }

    public function prosesLogout(){
        try {
            $session = session();
            $session->destroy();

            return redirect()->to('/');
            
        } catch (\Exception $e){
            die($e->getMessage());
        }
        
    }

    public function showData(){
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            
            echo view('login');
        }else{
            $this->db=db_connect();
            $builder=$this->db->table('data_keluarga');
            $builder->where('KD_USER', session()->get('user_name'));
            $query=$builder->get();
            $data['dt1']=$query->getResult();
            $this->db->close();

            echo view('header');
            echo view('yoyoDashboard',$data);
            
        }
        
    }
    
}
