<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
    
        $role_data = [
            [
                'id' => 1,
                'name' => "Admin"
            ]
        ];

        $user_data = [
            [
                'username' => 'admin',
                'password_hash' => password_hash('admin', PASSWORD_DEFAULT),
                'email' => 'admin@gmail.com',
                'num_tables' => 100
            ]

        ];

        $this->db->table('users')->insert($user_data[0]);
        $user_id = $this->db->insertID();

        $user_roles_data = [

            [
                'user_id' => $user_id,
                'role_id' => 1,

            ]
        ];
        
        $this->db->table('roles')->insertBatch($role_data);
        $this->db->table('user_roles')->insertBatch($user_roles_data);
        
    }
}