<?php

namespace App\Controllers;

use App\Models\MedicineModel;

class Dashboard extends BaseController
{
    protected $session;
    protected $medicineModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->medicineModel = new MedicineModel();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'totalMedicines' => $this->medicineModel->getTotalMedicines(),
            'totalStock' => $this->medicineModel->getTotalStock(),
            'expiredMedicines' => $this->medicineModel->getExpiredCount(),
            'medicines' => $this->medicineModel->findAll()
        ];
        
        return view('dashboard/index', $data);
    }
} 