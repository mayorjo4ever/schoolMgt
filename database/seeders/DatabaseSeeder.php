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
        ##$this->call(AdminsTableSeeder::class);
        ## $this->call(LevelsTableSeeder::class);
        # $this->call(StudentsTableSeeder::class);
        # $this->call(LevelCategoriesSeeder::class);
        # $this->call(RolePermissionSeeder::class);
        # $this->call(PaymentItemSeeder::class);

    }
}
