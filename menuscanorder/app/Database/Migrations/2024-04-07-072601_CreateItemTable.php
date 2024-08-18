<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemTable extends Migration
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
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => null
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'price' => [
                'type' => 'DECIMAL(10,2)'
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('category_id', 'category', 'id');
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->createTable('item');
    }

    public function down()
    {
        $this->forge->dropTable('item');
    }
}

