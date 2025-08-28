<?php namespace App\Models;
use CodeIgniter\Model;

class ProgramModel extends Model {
    protected $table = 'programs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','description','national_alignment','focus_areas','phases'];
    protected $useTimestamps = true;
}
