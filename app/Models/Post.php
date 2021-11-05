<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //? attributi che POSSONO essere mass-assign
    // protected $fillable = ['title', 'body', 'summary', 'id'];
    //? attributi che NON POSSONO essere mass-assign
     protected $guarded = ['id'];

    //? Risolve n+1 problems: eager loading by default
    protected $with = ['author', 'category'];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    public function author() //cerca author_id
    {
        return $this->belongsTo(User::class, 'user_id');
        //il secondo argomento specifica la foreign key in caso differente da quella standard "author_id"
    }
   
}
