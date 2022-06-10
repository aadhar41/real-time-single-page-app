<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('likes')->truncate();
        DB::table('questions')->truncate();
        DB::table('replies')->truncate();
        DB::statement("SET foreign_key_checks=1");

        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Question::factory(10)->create();

        \App\Models\Reply::factory(50)->create()
            ->each(function ($reply) {
                $reply->like()
                    ->saveMany(
                        \App\Models\Like::factory(1)->make()
                    );
            });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}