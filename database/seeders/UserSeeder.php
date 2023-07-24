<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'yogi',
                'sub_name' => 'YOGI SAPUTRA',
                'email' => 'yogi@gmail.com',
                'password' => Hash::make('yogi'),
                'roles'=>'tpl' 
            ],
            [
                'name' => 'rian',
                'sub_name' => 'RIAN ANDRIANI AZIZ',
                'email' => 'rian@gmail.com',
                'password' => Hash::make('rian'), 
                'roles'=>'tpl'
            ],
            [
                'name' => 'sandy',
                'sub_name' => 'SANDY MARTHA',
                'email' => 'sandy@gmail.com',
                'password' => Hash::make('sandy'), 
                'roles'=>'tpl'
            ],
            [
                'name' => 'iqbal',
                'sub_name' => 'IQBAL ABDURAHMAN',
                'email' => 'iqbal@gmail.com',
                'password' => Hash::make('iqbal'), 
                'roles'=>'tpl'
            ],
            [
                'name' => 'arjuna',
                'sub_name' => 'ARJUNA',
                'email' => 'arjuna@gmail.com',
                'password' => Hash::make('arjuna'), 
                'roles'=>'tpl'
            ],
            [
                'name' => 'agung',
                'sub_name' => 'AGUNG RAHAYU',
                'email' => 'agung@gmail.com',
                'password' => Hash::make('agung'), 
                'roles'=>'tpl'
            ],
            [
                'name' => 'admin',
                'sub_name' => 'ADMIN',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'), 
                'roles'=>'admin'
            ],
            [
                'name' => 'arip',
                'sub_name' => 'Muhamad Arip Budiman',
                'email' => 'arip@gmail.com',
                'password' => Hash::make('arip'), 
                'roles' => 'it', 
            ],
        ];

        // Masukkan data ke dalam tabel users
        DB::table('users')->insert($users);
    }
}
