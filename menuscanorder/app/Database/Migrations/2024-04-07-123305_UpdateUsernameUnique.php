<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ModifyUserTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ]
        ]);

    }

    public function down()
    {
        $this->forge->modifyColumn('user', [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
    }
}
