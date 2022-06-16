<?php 
namespace App\Controllers;

use mysqli;

class Page extends BaseController
{

    public function about(){
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            echo view('login');
        }else{

            echo view('header');
            echo "<center><strong>About page</strong></center>";
            
        }
        
    }

    public function contact(){
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            echo view('login');
        }else{
            echo view('header');
            echo "<center><strong>Contact page</strong></center>";
        }
    }

    public function faqs(){
        echo view('header');
        echo "<center><strong>Faqs page</strong></center>";
    }

    public function tes(){
        echo view('header');
        echo view('tes');
    }

    public function login(){
        if(! session()->get('logged_in')){
            // maka redirct ke halaman login
            echo view('login');
        }else{

            return redirect()->to('/'); 
            // echo view('yoyoDashboard',$data);
            
        }
    }

    public function teskonek(){
        echo view('header');
        $db = db_connect();
        if (!$db){
            die("koneksi gagal".mysqli_connect_error());
        }else{
            echo "<pre>";
            echo "//tes connect <br>";
            echo "koneksi berhasil";
            echo "</pre>";
        }

        $query = $db->query("select * from ci_data_keluarga;");
        $result = $query->getResult();
    
        echo "<pre>";
        echo "//get all row <br>";
	    print_r($query->getResult()); //get all row
        echo "</pre>";

        echo "<pre>";
        echo "//get data by row <br>";
	    print_r($query->getRow(1));  //by row
        echo "</pre>";

        echo "<pre>";
        echo "//get all row <br>";
        foreach ($query->getResult() as $row) { //tampilkan per row
            echo $row->NAMA_LENGKAP;
            echo $row->TGL_LAHIR;
            echo $row->STATUS;
        }
        echo "</pre>";

        echo "<pre>";
        echo "//tes insert <br>";
        // Prepare the Query
        $pQuery = $db->prepare(function ($db) {
            return $db->table('ci_data_keluarga')->insert([
                'nama_lengkap'    => 'nama_lengkap',
                'status'   => 'status',
                'tgl_lahir' => 'tgl_lahir'
            ]);
        });

        // Collect the Data
        $nama_lengkap    = 'John Doe';
        $status   = 'alkjlkj';
        $tgl_lahir = '2022-03-01';

        // Run the Query
        $results = $pQuery->execute($nama_lengkap, $status, $tgl_lahir);
        $pQuery->close();
        echo "insert berhasil";
        echo "</pre>";

        $db->close();
    }
}
?>