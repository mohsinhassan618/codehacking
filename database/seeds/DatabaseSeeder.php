<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        factory(App\Role::class,3)->create();
        factory(App\Photo::class,10)->create();
        factory(App\Category::class,9)->create();


        factory(App\User::Class,10)->create()->each(function ($user){
            $user->posts()->save(factory(App\Post::class)->make());
        });

        factory(App\Comment::Class,20)->create()->each(function ($comment){
            $comment->replies()->save(factory(App\CommentReply::class)->make());
        });

        // $this->call(UsersTableSeeder::class);
    }
}
