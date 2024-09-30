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
            'name'      => 'Suporte Ueek',
            'email'     => 'suporte@ueek.digital',
            'password'  => Hash::make('Ueek*109238'),
            'status'  => '1',
        ]);
    }
}
