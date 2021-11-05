<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Fa in modo che non vengano ri-seedate le tabelle se eseguito il comando più volte
        User::truncate();
        Post::truncate();
        Category::truncate();


        Post::factory(5)->create();
        
        // ?in caso si volessero passare nomi di user(class) specifici, quelli citati non verranno generati automaticamente        
        // $user = User::factory()->create([
        //     'name' => 'Jhon Doe',
        // ]);
            // ?in qusto caso si creano x nuovi post, che avranno lo stesso user id di quello generato in precedenza    
            // Post::factory(x)->create([
            //     'user_id' => $user->id
            // ])

        // ?creazione manuale di una categoria, salvata poi in una variabile
        // $personal = Category::create([
            //     'name' => 'Personal',
            //     'slug' => 'personal',
            // ]);
        // ?creazione manuale di un post, il cui user_id e category_id sono foreign key
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' =>$family->id,
        //     'title' => 'Post randomico tester',
        //     'slug' => 'post-randomico-tester',
        //     'summary' => 'summary del post randomico',
        //     'body' => 'summary del post randomico-summary del post randomico-summary del post randomicosummary del post randomicosummary del post randomicosummary del post randomico,',
        // ]);

    }
}
