<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlacedItemTable extends Migration
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
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('order_id', 'orders', 'id');
        $this->forge->addForeignKey('item_id', 'item', 'id');
        $this->forge->createTable('placed_item');
        
    }

    public function down()
    {
        $this->forge->dropTable('placed_item');
    }
}