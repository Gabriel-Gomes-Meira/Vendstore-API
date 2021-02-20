<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProdutosController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        $produtos = Produto::all();
        return response()->json([
            'Produtos' => $produtos
        ]);
    }


    public function create(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $validator = Validator::make($request->all(), Produto::$rules, Produto::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Produto = Produto::create($request->except('image'));
        $name = $request->name;
        $extension = $request->image->extension();
        $fileName = "$name.$extension";
        $request->image->storeAs('produto', $fileName);

        $Produto->image = $fileName;
        $Produto->save();
        return response()->json(['message' => 'Produto Cadastrado!'], 200);

    }

    public function update(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Produto::$rules, Produto::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Produto = Produto::find($request->id);
        if(!$Produto) {
            return response()->json(['message' => 'Não foi encontrado produto com esse "id"!'], 404);
        }

        $name = $request->name;
        $extension = $request->image->extension();
        $fileName = "$name.$extension";
        $request->image->storeAs('produto', $fileName);

        $Produto->image = $fileName;
        $Produto->name = $request->name;
        $Produto->price = $request->price;
        $Produto->quantidade = $request->quantidade;
        $Produto->moeda = $request->moeda;
        $Produto->save();
        return response()->json(['message' => 'Produto Atualizado!'], 200);
    }



    public function delete(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $Produto = Produto::find($request->id);

        if(!$Produto) {
            return response()->json(['message' => 'Não foi encontrado produto com esse "id"!'], 404);
        }

        $Produto->delete();

        return response()->json(['message' => 'Produto deletado com Sucesso!'], 200);
    }
}
