<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateProjectParticipants extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'project_id'=>['type'=>'INT','unsigned'=>true],
            'participant_id'=>['type'=>'INT','unsigned'=>true],
            'role_on_project'=>['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'skill_role'=>['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('project_id','projects','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('participant_id','participants','id','CASCADE','CASCADE');
        $this->forge->createTable('project_participants');
    }
    public function down(){ $this->forge->dropTable('project_participants'); }
}
