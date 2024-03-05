<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

       $this->call([
           UserTableSeeder::class,
           AdminTableSeeder::class,
//           AppointmentSeeder::class,
           SectiontableSeeder::class,
           DoctorTableSeeder::class,
           ImageTableSeeder::class,
           PatientTableSeeder::class,
           ServiceTableSeeder::class,
           RayEmployeeTableSeeder::class,



       ]);
    }
}
