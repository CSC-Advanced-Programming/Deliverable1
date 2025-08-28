<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreatePrograms extends Migration {
    public function up(){
        $this->forge->addField([
            'id'                => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'name'              => ['type'=>'VARCHAR','constraint'=>200],
            'description'       => ['type'=>'TEXT','null'=>true],
            'national_alignment'=> ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'focus_areas'       => ['type'=>'TEXT','null'=>true],
            'phases'            => ['type'=>'TEXT','null'=>true],
            'created_at'        => ['type'=>'DATETIME','null'=>true],
            'updated_at'        => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('programs');
    }
    public function down(){ $this->forge->dropTable('programs'); }
}
