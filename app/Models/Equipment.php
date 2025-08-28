<?php namespace App\Models;
use CodeIgniter\Model;

class EquipmentModel extends Model {
    protected $table = 'equipment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['facility_id','name','capabilities','description','inventory_code','usage_domain','support_phase'];
    protected $useTimestamps = true;
}
