<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable=['name'];

    //===============================
    /**
 * Define a relação de um para muitos (1:N) com o model Book.
 * Indica que este registro (ex: Autor/Categoria) possui muitos livros associados.
 * **/

    public function books()
    {
       return $this->hasMany(Book::class); 
    }
}