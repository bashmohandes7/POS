<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Ahmed', 'Mohamed'];

        foreach ($clients as $client){
            Client::create([
                'name' => $client,
                'phone' => '011448787',
                'address' =>'kfs'
            ]);

        } // end of foreach

    } // end of run
} // end of seeder
