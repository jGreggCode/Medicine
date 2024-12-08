<?php

namespace App\Controllers;

use App\Models\MedicineModel;

class Medicine extends BaseController
{
    protected $medicineModel;
    protected $session;

    public function __construct()
    {
        $this->medicineModel = new MedicineModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $data['medicines'] = $search ? 
            $this->medicineModel->searchMedicines($search) : 
            $this->medicineModel->findAll();
        
        return view('medicine/index', $data);
    }

    public function create()
    {
        return view('medicine/create');
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'brand' => $this->request->getPost('brand'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'expirationDate' => $this->request->getPost('expirationDate'),
            'isExpired' => strtotime($this->request->getPost('expirationDate')) < time() ? 'yes' : 'no'
        ];

        if ($this->medicineModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Medicine added successfully']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add medicine']);
    }

    public function edit($id)
    {
        $data['medicine'] = $this->medicineModel->find($id);
        return view('medicine/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'brand' => $this->request->getPost('brand'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'expirationDate' => $this->request->getPost('expirationDate'),
            'isExpired' => strtotime($this->request->getPost('expirationDate')) < time() ? 'yes' : 'no'
        ];

        if ($this->medicineModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Medicine updated successfully']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update medicine']);
    }

    public function delete($id)
    {
        if ($this->medicineModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Medicine deleted successfully']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete medicine']);
    }

    public function get($id)
    {
        return $this->response->setJSON($this->medicineModel->find($id));
    }
} 