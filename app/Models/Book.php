<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre_id',
        'published_year',
        'description',
        'cover'
    ];
    //============================
    /**
 * Define a relação inversa de muitos para um (N:1) com o model Genre.
 * Indica que este livro pertence a um único gênero literário.
 **/
    public function genre()
    {
      return $this->belongsTo(Genre::class);
    }
    
   
}
