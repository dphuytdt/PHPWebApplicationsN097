<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
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
    }
}
