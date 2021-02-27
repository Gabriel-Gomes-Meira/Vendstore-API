<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Moeda extends Model implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'pais',
        'sigla'
    ];

    public static $rules = array(
        'pais' => 'required | string',
        'sigla' => 'required | string | max:10 | unique:moedas,sigla'
    );

    public static $messages = array(
        'pais.required' => 'Campo "Pais" é requerido!',
        'pais.string' => 'Campo "Pais" deve ser preenchido com uma string!',
        'sigla.required' => 'Campo "sigla" é requerido!',
        'sigla.unique' => 'Já há Moeda com essa sigla cadastrada!',
        'sigla.string' => 'Campo "sigla" dever ser preenchido com uma string!',
        'sigla.max' => 'Subrepos a capacidade máxima de caracteres em "sigla" (10)!'
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
