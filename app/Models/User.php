<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//CRUD - Create, Read, Update, Delete
//create=> user::create(['name'=>'John Doe', 'email'=>'john@example.com', 'password'=>'123456']);
//read => User::find(1);
//update=> user::update(['name'=>'fulano']);
//delete=> user::delete(1);

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
   /**
     *
     * @var list<string>
     */

    // autoriza o laravel fazer update em massa nesses campos, ou seja, quando o usuário se cadastrar, ele vai poder preencher esses campos.
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Os atributos que devem ser ocultados quando forem pegar dados no banco de dados, ou seja, quando for pegar os dados do usuário, não vai mostrar a senha e o token de lembrar.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        //informa o tipo de dado que o laravel deve esperar, ou seja, quando for pegar os dados do usuário, ele vai esperar que o email_verified_at seja um datetime e a senha seja um hashed.
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',  //responsável por criptografar a senha do usuário, ou seja, quando o usuário se cadastrar, a senha dele vai ser criptografada e armazenada no banco de dados.
        ];
    }
}
