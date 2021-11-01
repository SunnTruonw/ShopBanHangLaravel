<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class tbl_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
                'level' => 1
            ],
            [
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('12345'),
                'level' => 1
            ],
        ];
        DB::table('users')->insert($data);
    }
}
