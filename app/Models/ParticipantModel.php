<?php namespace App\Models;
use CodeIgniter\Model;

class ParticipantModel extends Model {
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['full_name','email','affiliation','specialization','cross_skill_trained','institution'];
    protected $useTimestamps = true;
}
