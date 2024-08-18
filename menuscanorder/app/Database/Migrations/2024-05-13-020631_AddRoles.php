<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('roles');
        
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}