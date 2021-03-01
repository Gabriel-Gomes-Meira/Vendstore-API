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
        'name' => 'sometimes | required | unique:produtos,name',
        'price' => 'sometimes | required | numeric',
        'quantidade' => 'sometimes | required | numeric',
        'image'=>'sometimes | required | image',
        'moeda_id' => 'sometimes |required | exists:App\Models\Moedas,id',
        'categoria_id' => 'sometimes | required | exists:App\Models\Categoria,id',
        'marca_id' => 'sometimes | required | exists:App\Models\Marca,id',

    );


    public static $messages = array(
        'name.required' => 'Campo NOME é requerido!',
        'name.unique' => 'Já há um produto cadastrado com este nome!',
        'price.required' => 'Campo preço é requerido!',
        'price.numeric' => 'Campo preço deve ser numérico!',
        'moeda.required' => 'Campo moeda é requerido!',
        'moeda.exists' => 'Não há moeda com esse id definido na base de dados!',
        'categoria.required' => 'Campo categoria é requerido!',
        'categoria.exists' => 'Não há categoria com esse id definido na base de dados!',
        'marca.required' => 'Campo marca é requerido!',
        'marca.exists' => 'Não há marca com esse id definido na base de dados!',
        'quantidade.required' => ' Campo "quantidade" é obrigatório o preenchimento!',
        'quantidade.numeric' => 'Campo "quantidade" deve ser numérico!',
        'image.image' => 'Campo "image" precisa ser preenchido com arquivo de imagem!',
        'image.required' => 'Campo "imagem" é obrigatório o preenchimento!'
    );

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function Moeda(){
        return $this->belongsTo(Moeda::class);
    }

    public function Marca(){
        return $this->belongsTo(Marca::class);
    }

    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }

}
