<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    User::create([
        'name'=>'Jason',
        'email'=>'jasonsetiawan2k3@gmail.com',
        'password'=>bcrypt('12345'),
        'role'=>'manager'
    ]);

    User::create([
        'name'=>'Dummy1',
        'email'=>'Dummy1@gmail.com',
        'password'=>bcrypt('123'),
        'role'=>'user'
    ]);

    // Services
    Service::create(['name'=>'Basic Service','description'=>'Basic','price'=>100]);
    Service::create(['name'=>'Premium Service','description'=>'Premium','price'=>500]);

    // Lead
    Lead::create(['name'=>'Budi','company'=>'Google','email'=>'Budi@gmail.com','phone'=>'081234567']);
    Lead::create(['name'=>'Ani','company'=>'Netflix','email'=>'Ani@gmail.com','phone'=>'081234568']);
    }
}
