<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->count(300)->create();

        foreach ($user as $item) {
            UserDetail::factory()->create([
                'user_id' => $item->id,
            ]);
        }

        User::factory()->create([
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'ROLE_ADMIN',
            'is_active' => 1,
            'created_at' => '2021-07-01 00:00:00',
        ]);

        UserDetail::factory()->create([
            'user_id' => 301,
        ]);

        User::factory()->create([
            'email' => 'user@yopmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'ROLE_USER',
            'is_active' => 1,
            'created_at' => '2021-07-01 00:00:00',
        ]);

        UserDetail::factory()->create([
            'user_id' => 302,
        ]);
    }
}
