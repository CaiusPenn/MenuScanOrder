<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateOrdersTable extends Migration
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
            'table_number' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'is_complete' => [
                'type' => 'bool',
                'default' => false
            ],
            'order_date' => [
                'type' => 'INT',
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->createTable('orders');
        
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}