<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoryTable extends Migration
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
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->createTable('category');
        
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}