<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Categoria extends Model implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $rules = array(
        'name' => 'required| unique:categorias,name| string'
    );

    public static $messages = array(
        'name.required' => 'Campo "name" é requerido!',
        'name.string' => 'Campo "name" dever ser preenchido com uma string!',
        'name.unique' => 'Já há categoria com esse nome cadastrada!'
    );

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function produtos() {
        return $this->hasMany(Produto::class);
    }
}
