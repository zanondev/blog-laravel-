<?php

namespace Database\Seeders;

use App\Models\Admin;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'      => 'Lucas',
            'email'     => 'szanonn@gmail.com',
            'password'  => Hash::make('lucas#ueek'),
            'status'  => '1',
        ]);
    }
}
