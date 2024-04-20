<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'youness louiza',
            'email' => 'younesslouizapro@gmail.com',
            'password' => Hash::make('youness'),
            'phone_number' =>'0630115923',
        ]);

        DB::table('users')->insert([
            'name' => 'Uness louiza',
            'email' => 'youness@admin.com',
            'password' => Hash::make('youness'),
            'phone_number' =>'0630115920',
        ]);
            
    }
}
