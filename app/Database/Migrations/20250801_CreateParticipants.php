<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateParticipants extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'full_name'=>['type'=>'VARCHAR','constraint'=>180],
            'email'=>['type'=>'VARCHAR','constraint'=>190,'null'=>true],
            'affiliation'=>['type'=>'VARCHAR','constraint'=>120,'null'=>true],
            'specialization'=>['type'=>'VARCHAR','constraint'=>120,'null'=>true],
            'cross_skill_trained'=>['type'=>'TINYINT','constraint'=>1,'default'=>0],
            'institution'=>['type'=>'VARCHAR','constraint'=>150,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('participants');
    }
    public function down(){ $this->forge->dropTable('participants'); }
}
