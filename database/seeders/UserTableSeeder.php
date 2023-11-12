<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ANDI RAIS DENNY',
            'username' => 199999999999999999,
            'email' => 'siasn@bonebolangokab.go.id',
            'password' => Hash::make('123456'),
        ]);
    }
}
