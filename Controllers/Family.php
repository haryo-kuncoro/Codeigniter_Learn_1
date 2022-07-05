<?php
 
namespace App\Controllers;

use App\Models\FamilyModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
 
class Family extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new FamilyModel();
        $data['family'] = $model->orderBy('id', 'ASC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new FamilyModel();
        $data = [
            'NAMA_LENGKAP' => $this->request->getVar('namalengkap'),
            'TGL_LAHIR'  => $this->request->getVar('tgllahir'),
            'STATUS' => $this->request->getVar('status'),
            'KD_USER'  => $this->request->getVar('user'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new FamilyModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new FamilyModel();
        $id = $this->request->getVar('id');
        $data = [
            'NAMA_LENGKAP' => $this->request->getVar('namalengkap'),
            'TGL_LAHIR'  => $this->request->getVar('tgllahir'),
            'STATUS' => $this->request->getVar('status'),
            'KD_USER'  => $this->request->getVar('kduser'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new FamilyModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
