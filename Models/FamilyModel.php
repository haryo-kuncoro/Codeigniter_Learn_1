<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class FamilyModel extends Model
{
    protected $table = 'ci_data_keluarga';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['NAMA_LENGKAP','TGL_LAHIR','STATUS','KD_USER'];
}
