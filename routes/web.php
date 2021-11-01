<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\Data\SymfonyYamlFrontMatterParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // ?Debugging
    // \Illuminate\Support\Facades\DB::listen(function($query){
    //     // \Illuminate\Support\Facades\Log::info($query->sql)
    //     logger($query->sql, $query->bindings);
    // });
    return view('posts', [
    //    'posts'=> Post::all()
    //    specificando la categorie "with category" e poi usando il get, si bypassa il problema del n+1:performa x query per x elementi dell'array
    //    'posts'=> Post::latest()->with('category')->get() // con latest le mette in ordine, si può specificare la colonna
        
        'posts'=> Post::latest()->get()

    ]);    
});

    // * per mostrare gli elementi del metadata
    // ddd($posts[0]-> title);
    // ddd($doc->title); property access
    // ddd($doc->matter('title')); 
    
// !ROUTE DEI POST: VISUALIZZAZIONE E ACCESSO A POST DIFFERENTI
// ! opzione 1:  variabile di post e return della variabile
// Route::get('post', function () {   
//     $post =  file_get_contents(__DIR__ . '/../resources/posts/post-1.html');
//     return view('post', [
//         'post' => $post
//     ]);
// });

// ! opzione 2: utilizzo dello slug per rendere gli url e la visualizzazione dei post più dinamica.
//  {post} è la cosidetta "wildcard" 
// Route::get('posts/{post}', function ($slug) {

//     $post_path = __DIR__ . "/../resources/posts/{$slug}.html";
    
//     if (!file_exists($post_path)) {
//         //* dd = die and dump, quick debug, schermata "codice"
//         // dd("file does not exist");
//         //* ddd = dump, die and debug, schermata di errore laravel
//         // ddd("file does not exist");
//         //* abort classico errore 404
//         // // abort(404);
//         //*  reindirizza l'utente al path specificato, in questo caso "/"
//         // return redirect('/');
//         return view ('not_found');
//     }

//     //* CACHE : Salvare "in cache" la pagina, senza doverla ricaricare ad ogni refresh
//     // sintassi: $var = cahce -> remember (unique_key, cache_time, function(), use)
//     // cache_time = valore standard secondi, oppure now() ->addHours()/addMinutes()/addDays()...
//     // use = serve ad "importare" la variabile all'interno della funzione
//     $post = cache() ->remember ("posts.{slug}", now()->addMinutes(10), function() use ($post_path) {
//         return file_get_contents($post_path);
//     }); // with arrows functions : fn () => file_get_contents($post_path))

//     return view('post', ['post' => $post ]);


// ! opzione 4 : stessa cosa con l'utilizzo della classe Post (../Model/Post.php) whatever binding
Route::get('posts/{post:slug}', function(Post $post) {
//? trova un post grazie al'Id (find) e lo passa ('post' => $post) alla view "post" (return)
    return view('post', [
        'post' => $post
    ]);
});
// ->where('post', '[A-Za-z-/_]+'); restrizioni sull'url


Route::get('categories/{category:slug}', function(Category $category) {
    
    return view('posts', [
            'posts' => $category->posts
        ]);
});

Route::get('users/{user:username}', function(User $user) {
    
    dd($user);
    dd($user->posts);

    return view('posts', [
            'posts' => $user->posts,
            'userDebug' => $user
            // 'posts' => $user->posts->load(['category', 'user'])
        ]);
});


Route::get('/home', function () {
    return view('welcome');
});