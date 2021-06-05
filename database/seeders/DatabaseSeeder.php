<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $stu = new User();
        $stu->create([
            'name' => 'Stuart Creed',
            'email' => 'stuart.a.creed@gmail.com',
            'password' => Hash::make('food')
        ]);
    }
}
