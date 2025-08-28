<?php namespace App\Models;
use CodeIgniter\Model;

class ServiceModel extends Model {
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['facility_id','name','description','category','skill_type'];
    protected $useTimestamps = true;
}
