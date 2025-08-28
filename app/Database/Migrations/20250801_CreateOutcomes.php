<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateOutcomes extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'project_id'=>['type'=>'INT','unsigned'=>true],
            'title'=>['type'=>'VARCHAR','constraint'=>220],
            'description'=>['type'=>'TEXT','null'=>true],
            'artifact_link'=>['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'outcome_type'=>['type'=>'VARCHAR','constraint'=>80,'null'=>true],
            'quality_certification'=>['type'=>'TEXT','null'=>true],
            'commercialization_status'=>['type'=>'VARCHAR','constraint'=>80,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('project_id','projects','id','CASCADE','CASCADE');
        $this->forge->createTable('outcomes');
    }
    public function down(){ $this->forge->dropTable('outcomes'); }
}
