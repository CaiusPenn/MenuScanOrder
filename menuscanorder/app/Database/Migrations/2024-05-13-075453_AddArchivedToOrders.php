<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ArchivedFieldToOrdersTable extends Migration
{
    public function up()
    {
        $fields = [
            'archived' => [
                'type' => 'bool',
                'default' => false
            ]
        ];
        $this->forge->addColumn('orders', $fields);
        
    }

    public function down()
    {
        $this->forge->dropColumn('orders', 'archived');
    }
}
