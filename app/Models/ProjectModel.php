<?php namespace App\Models;
use CodeIgniter\Model;

class ProjectModel extends Model {
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['program_id','facility_id','title','nature_of_project','description','innovation_focus','prototype_stage','testing_requirements','commercialization_plan'];
    protected $useTimestamps = true;
}
