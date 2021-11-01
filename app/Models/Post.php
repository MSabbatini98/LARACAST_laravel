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

     protected $with = ['user', 'category'];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function user() //user_id
    {
        return $this->belongsTo(User::class);
    }
}
