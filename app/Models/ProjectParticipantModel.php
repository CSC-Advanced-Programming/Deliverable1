<?php namespace App\Models;
use CodeIgniter\Model;

class ProjectParticipantModel extends Model {
    protected $table = 'project_participants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['project_id','participant_id','role_on_project','skill_role'];
    protected $useTimestamps = true;
}
