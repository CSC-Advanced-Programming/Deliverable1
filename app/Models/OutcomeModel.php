<?php namespace App\Models;
use CodeIgniter\Model;

class OutcomeModel extends Model {
    protected $table = 'outcomes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['project_id','title','description','artifact_link','outcome_type','quality_certification','commercialization_status'];
    protected $useTimestamps = true;
}
