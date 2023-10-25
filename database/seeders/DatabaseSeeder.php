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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Karyawan::create([
            'nik'=>'120140100',
            'nama'=>'Ben Dover',
            'Jabatan'=>'Intern',
            'no_hp'=>'08127483954',
            'password'=>'$2y$10$JG5pz/Fw7YN1G8g6V.K7i.arAUhapRlX9VlUNZBUqLIq7ZsAlTS0K',
        ]);

        \App\Models\User::create([
            'name'=>'William',
            'email'=>'william@gmail.com',
            'password'=>'$2y$10$JG5pz/Fw7YN1G8g6V.K7i.arAUhapRlX9VlUNZBUqLIq7ZsAlTS0K',
        ]);
    }
}
