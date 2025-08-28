<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateEquipment extends Migration {
    public function up(){
        $this->forge->addField([
            'id'=>['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'facility_id'=>['type'=>'INT','unsigned'=>true],
            'name'=>['type'=>'VARCHAR','constraint'=>150],
            'capabilities'=>['type'=>'TEXT','null'=>true],
            'description'=>['type'=>'TEXT','null'=>true],
            'inventory_code'=>['type'=>'VARCHAR','constraint'=>120,'null'=>true],
            'usage_domain'=>['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'support_phase'=>['type'=>'VARCHAR','constraint'=>100,'null'=>true],
            'created_at'=>['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('facility_id','facilities','id','CASCADE','CASCADE');
        $this->forge->createTable('equipment');
    }
    public function down(){ $this->forge->dropTable('equipment'); }
}
