<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Produto extends Model implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'moeda',
        'quantidade'
    ];

    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'moeda' => 'required',
        'quantidade' => 'required',
        'image'=>'required'
    );

    public static $messages = array(
        'name.required' => 'Campo NOME é requerido!',
        'price.required' => 'Campo preço é requerido!',
        'moeda.required' => 'Campo moeda é requerido',
        'quantidade.required' => ' Campo "quantidade" é obrigatório o preenchimento!',
        'image.required' => 'Campo "imagem" é obrigatório o preenchimento'
    );

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

}