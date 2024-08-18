<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddCategoryFieldToUserTable extends Migration
{
    public function up()
    {
        $fields = [
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ];
        $this->forge->addColumn('item', $fields);
        $this->forge->addForeignKey('category_name', 'category', 'category_name');
    }

    public function down()
    {
        $this->forge->dropColumn('item', 'category_name');
    }
}