<?php namespace App\Models;
use CodeIgniter\Model;

class FacilityModel extends Model {
    protected $table = 'facilities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','location','description','partner_organization','facility_type','capabilities'];
    protected $useTimestamps = true;
}
