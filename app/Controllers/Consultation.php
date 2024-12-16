<?php

namespace App\Controllers;

use App\Models\ConsultationModel;

class Consultation extends BaseController
{
  protected $consultationModel;
  protected $session;

  public function __construct()
  {
    $this->consultationModel = new ConsultationModel();
    $this->session = \Config\Services::session();
  }

  public function store()
  {
    $data = [
      'patient_name' => $this->request->getPost('patient_name'),
      'age' => $this->request->getPost('age'),
      'gender' => $this->request->getPost('gender'),
      'contact_number' => $this->request->getPost('contact_number'),
      'visit_date' => date('Y-m-d H:i:s'),
      'symptoms' => $this->request->getPost('symptoms'),
      'diagnosis' => $this->request->getPost('diagnosis'),
      'treatment' => $this->request->getPost('treatment'),
      'prescribed_medicines' => $this->request->getPost('prescribed_medicines'),
      'notes' => $this->request->getPost('notes'),
      'next_visit' => $this->request->getPost('next_visit')
    ];

    try {
      if ($this->consultationModel->insert($data)) {
        return $this->response->setJSON([
          'status' => 'success',
          'message' => 'Consultation record added successfully'
        ]);
      }
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to add consultation record: ' . $e->getMessage()
      ]);
    }

    return $this->response->setJSON([
      'status' => 'error',
      'message' => 'Failed to add consultation record'
    ]);
  }

  public function get($id)
  {
    return $this->response->setJSON($this->consultationModel->find($id));
  }

  public function update($id)
  {
    $data = [
      'patient_name' => $this->request->getPost('patient_name'),
      'age' => $this->request->getPost('age'),
      'gender' => $this->request->getPost('gender'),
      'contact_number' => $this->request->getPost('contact_number'),
      'symptoms' => $this->request->getPost('symptoms'),
      'diagnosis' => $this->request->getPost('diagnosis'),
      'treatment' => $this->request->getPost('treatment'),
      'prescribed_medicines' => $this->request->getPost('prescribed_medicines'),
      'notes' => $this->request->getPost('notes'),
      'next_visit' => $this->request->getPost('next_visit')
    ];

    try {
      if ($this->consultationModel->update($id, $data)) {
        return $this->response->setJSON([
          'status' => 'success',
          'message' => 'Consultation record updated successfully'
        ]);
      }
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to update consultation record: ' . $e->getMessage()
      ]);
    }

    return $this->response->setJSON([
      'status' => 'error',
      'message' => 'Failed to update consultation record'
    ]);
  }

  public function delete($id)
  {
    try {
      if ($this->consultationModel->delete($id)) {
        return $this->response->setJSON([
          'status' => 'success',
          'message' => 'Consultation record deleted successfully'
        ]);
      }
    } catch (\Exception $e) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to delete consultation record: ' . $e->getMessage()
      ]);
    }

    return $this->response->setJSON([
      'status' => 'error',
      'message' => 'Failed to delete consultation record'
    ]);
  }
}
