<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(LocationSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(CreatorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SearchSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(EditionSeeder::class);
    }
}
