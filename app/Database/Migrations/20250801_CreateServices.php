<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateServices extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'facility_id'=>['type'=>'INT','unsigned'=>true],
            'name'=>['type'=>'VARCHAR','constraint'=>150],
            'description'=>['type'=>'TEXT','null'=>true],
            'category'=>['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'skill_type'=>['type'=>'VARCHAR','constraint'=>80,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('facility_id','facilities','id','CASCADE','CASCADE');
        $this->forge->createTable('services');
    }
    public function down(){ $this->forge->dropTable('services'); }
}
