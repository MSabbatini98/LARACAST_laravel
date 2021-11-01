<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class Post 
{
    public $title;
    public $date;
    public $body;
    public $slug;

    // ! CONTSRUCTOR 
    public function __construct($title, $date, $body, $slug)
    {
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }



    // ! ALL
    public static function all() 
    {       
        
        // * loop + return array => array_map
        // ! basic approach
        // $posts = [];
        // $files = File::files(resource_path("posts"));
        // foreach($files as $file) {
            //     $doc = YamlFrontMatter::parseFile($file);

            //     $posts[] = new Post(
                //         $doc -> title,
        //         $doc -> date,
        //         $doc -> body(), 
        //         $doc -> slug,
        //     );
        // }
        
        // ! array_map approach
        // $files = File::files(resource_path("posts"));
        // $posts =  array_map(function($file) {
            //     $doc = YamlFrontMatter::parseFile($file);
            
        //      return new Post(
            //         $doc -> title,
            //         $doc -> date,
        //         $doc -> body(), 
        //         $doc -> slug,
        //     );
        // }, $files);

        // ! collection approach: collections are arrays more versatiles
        // // Trova tutti i file nella cartella post e salvali in una collection
        $files = File::files(resource_path("posts"));
        return collect($files)
        // cicla su ogni elemento della directory e Analizza ogni file(PARSE) e crea una collezione di documenti 
        ->map(function($file){
            $doc = YamlFrontMatter::parseFile($file);
            return $doc;
        })
        // Il secondo map prende ogni singolo  documento e crea un oggetto di tipo post con i dati forniti (title, date etc...)
        ->map(function($doc){

            return new Post(
                $doc -> title,
                $doc -> date,
                $doc -> body(), 
                $doc -> slug,
            );
        })->sortByDesc('date');

        // ! Sta volta salviamo in cache i dati dei post per sempre, in modo da non dover ricaricare i file ogni volta. 
        // In tal modo all'inserimento di un nuovo post, dovremmo manualmente svuotare il cache per poi farlo ricaricare con tutti i nuovi post aggiornati. Per ridurre il grado di complessità i post NON verranno salvati in cache
        //* Per poter verificare il cache possiamo accedere con dal terminal  |php artisan tinker|, visualizzare il cache |cache('posts.all')| oppure cache()->get('posts.all')|, liberare il cache |cache()-> forget('posts.all')|   
        // return cache()->rememberForever('posts.all', function() {
        //     return collect(File::files(resource_path("posts")))
        //     // cicla su ogni elemento della directory e Analizza ogni file(PARSE) e crea una collezione di documenti 
        //     ->map(function($file){
        //         $doc = YamlFrontMatter::parseFile($file);
        //         return $doc;
        //     })
        //     // Il secondo map prende ogni singolo  documento e crea un oggetto di tipo post con i dati forniti (title, date etc...)
        //     ->map(function($doc){
    
        //         return new Post(
        //             $doc -> title,
        //             $doc -> date,
        //             $doc -> body(), 
        //             $doc -> slug,
        //         );
        //     })->sortByDesc('date');
        // });
        
    }

    //! FIND tramite url
    // public function find($slug)
    // {
    //     // Laravel offre delle funzioni helper, che danno il path (base_path, app_path, resources_path...) 
    //     // __DIR__ . "/../resources/blabla ==> resource_path(blabla)
    //     $post_path = resource_path("posts/{$slug}.html"); 
        
    //     if (!file_exists($post_path)) {
    //         throw new ModelNotFoundException();
    //     }
    //     return cache() -> remember("posts.{$slug}", 120, fn() => file_get_contents($post_path));
    // }
    // ! FIND 
    public static function find($slug) 
    // tra tutti i post del blog, trova quello con lo slug uguale a quello richiesto
    {


        return static::all()->firstWhere('slug', $slug);;
    }
    // ! FIND_OR_FAIL 
    public static function findOrFail($slug) 
    // tra tutti i post del blog, trova quello con lo slug uguale a quello richiesto
    {
        $post= static::find($slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
    
}








?>