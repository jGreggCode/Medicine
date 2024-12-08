<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicineModel extends Model
{
    protected $table = 'medicines';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'brand', 'price', 'stock', 'creation_date', 'expirationDate', 'isExpired', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'creation_date';
    protected $updatedField = 'updated_at';

    // Get count of all medicines
    public function getTotalMedicines()
    {
        return $this->countAll();
    }

    // Get sum of all stock
    public function getTotalStock()
    {
        return $this->selectSum('stock')->get()->getRow()->stock ?? 0;
    }

    // Get count of expired medicines
    public function getExpiredCount()
    {
        return $this->where('isExpired', 'yes')->countAllResults();
    }

    // Search medicines
    public function searchMedicines($search)
    {
        return $this->like('name', $search)
                    ->orLike('brand', $search)
                    ->orLike('description', $search)
                    ->findAll();
    }
} 