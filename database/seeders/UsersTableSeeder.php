<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'super admin',
            'email' => 'super_admin@app.com',
            'password'=> bcrypt('123456')
        ]);
        $user->attachRole('super_admin');
    }// end of run
}// end of seeder
