<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateProjects extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'program_id'=>['type'=>'INT','unsigned'=>true],
            'facility_id'=>['type'=>'INT','unsigned'=>true],
            'title'=>['type'=>'VARCHAR','constraint'=>220],
            'nature_of_project'=>['type'=>'VARCHAR','constraint'=>80,'null'=>true],
            'description'=>['type'=>'TEXT','null'=>true],
            'innovation_focus'=>['type'=>'TEXT','null'=>true],
            'prototype_stage'=>['type'=>'VARCHAR','constraint'=>80,'null'=>true],
            'testing_requirements'=>['type'=>'TEXT','null'=>true],
            'commercialization_plan'=>['type'=>'TEXT','null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
            'updated_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('program_id','programs','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('facility_id','facilities','id','CASCADE','CASCADE');
        $this->forge->createTable('projects');
    }
    public function down(){ $this->forge->dropTable('projects'); }
}
