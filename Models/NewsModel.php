<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class NewsModel extends Model
{
    protected $table = 'ci_post_news';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['KATEGORI','PUBLISHDATE','EDITOR','AKTIF','HEADLINE','GAMBAR','JUDUL','KONTEN'];
}