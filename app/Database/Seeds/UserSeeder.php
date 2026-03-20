<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. DISABLE foreign key checks to allow truncating
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        
        // 2. CLEAR the table so we don't get "Duplicate Entry" errors
        $this->db->table('users')->truncate();
        
        // 3. RE-ENABLE foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

        $defaultPassword = password_hash('Password1', PASSWORD_BCRYPT);

        $data = [
            [
                'name'     => 'System Admin',
                'email'    => 'admin@school.edu',
                'password' => $defaultPassword,
                'role_id'  => 1,
            ],
            [
                'name'     => 'Main Teacher',
                'email'    => 'teacher@school.edu',
                'password' => $defaultPassword,
                'role_id'  => 2,
            ],
            [
                'name'     => 'Regular Student',
                'email'    => 'student@school.edu',
                'password' => $defaultPassword,
                'role_id'  => 3,
            ],
            [
                'name'     => 'Course Coordinator',
                'email'    => 'coord@school.edu',
                'password' => $defaultPassword,
                'role_id'  => 4,
            ],
        ];

        // 4. Insert the fresh data
        $this->db->table('users')->insertBatch($data);
    }
}