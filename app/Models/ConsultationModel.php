<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultationModel extends Model
{
  protected $table = 'consultations';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'patient_name',
    'age',
    'gender',
    'contact_number',
    'visit_date',
    'symptoms',
    'diagnosis',
    'treatment',
    'prescribed_medicines',
    'notes',
    'next_visit'
  ];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';

  // Get total consultations
  public function getTotalConsultations()
  {
    return $this->countAll();
  }

  // Get today's consultations
  public function getTodayConsultations()
  {
    return $this->where('DATE(visit_date)', date('Y-m-d'))->countAllResults();
  }

  // Get pending follow-ups
  public function getPendingFollowups()
  {
    return $this->where('next_visit >=', date('Y-m-d'))
      ->countAllResults();
  }

  // Search consultations
  public function searchConsultations($search)
  {
    return $this->like('patient_name', $search)
      ->orLike('symptoms', $search)
      ->orLike('diagnosis', $search)
      ->findAll();
  }

  // Get active patients (patients with ongoing treatment or follow-ups)
  public function getActivePatients()
  {
    $today = date('Y-m-d');
    $subquery = $this->db->table('consultations')
      ->select('patient_name')
      ->where('next_visit >=', $today)
      ->orWhere('DATE(visit_date)', $today)
      ->distinct()
      ->getCompiledSelect();

    $result = $this->db->query($subquery)->getNumRows();
    return $result;
  }

  // Get weekly cases (consultations in the last 7 days)
  public function getWeeklyCases()
  {
    $lastWeek = date('Y-m-d', strtotime('-7 days'));
    return $this->where('visit_date >=', $lastWeek)
      ->countAllResults();
  }

  // Get total records (all consultations)
  public function getTotalRecords()
  {
    return $this->countAll();
  }
}
