<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{

    protected const TABLE = 'users';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table(self::TABLE)->insert([
            [
                'name' => 'mario',
                'email' => 'mario@nintendo.com',
                'password' => bcrypt('mario'),
                'is_admin' => true,
            ],
            [
                'name' => 'luigi',
                'email' => 'luigi@nintendo.com',
                'password' => bcrypt('luigi'),
                'is_admin' => false,
            ]
        ]);
    }
}
