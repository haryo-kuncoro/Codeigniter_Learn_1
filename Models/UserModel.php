<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model
{
    protected $table = 'ci_data_user';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['KD_USER','NM_USER','PWD'];
}
