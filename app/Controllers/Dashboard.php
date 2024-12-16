<?php

namespace App\Controllers;

use App\Models\MedicineModel;

class Dashboard extends BaseController
{
    protected $session;
    protected $consultationModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->consultationModel = new \App\Models\ConsultationModel();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'activePatients' => $this->consultationModel->getActivePatients(),
            'weeklyCases' => $this->consultationModel->getWeeklyCases(),
            'totalRecords' => $this->consultationModel->getTotalRecords(),
            'consultations' => $this->consultationModel->orderBy('visit_date', 'DESC')->findAll()
        ];

        return view('dashboard/index', $data);
    }
}
