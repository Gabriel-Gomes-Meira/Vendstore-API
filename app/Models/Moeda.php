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
        'pais' => 'required',
        'sigla' => 'required'
    );

    public static $messages = array(
        'pais.required' => 'Campo Pais é requerido!',
        'sigla.required' => 'Campo sigla é requerido!'
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
