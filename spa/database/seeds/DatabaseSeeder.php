<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Article;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'testroot@gmail.com',
            'password' => Hash::make('testroot')
        ]);

        factory(Article::class)->times(20)->create();
        factory(Comment::class)->times(10)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
