<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        Image::factory(20)->create();
        Comment::factory(40)->create();
        Like::factory(40)->create();
        
        DB::table('users')->insert([
            'role' => "user",
            'name' => "saul",
            'surname' => "zarate",
            'nick' => "saulZarate",
            'email' => "saul.zarate@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt("12345678"), // password
            'image' => "https://picsum.photos/id/237/200/300",
            'remember_token' => Str::random(10),
        ]);
    }
}
