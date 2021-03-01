<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        $Categorias = Categoria::all();
        return response()->json([
            'Categorias' => $Categorias
        ]);
    }


    public function create(Request $request)
    {

        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Categoria::$rules, Categoria::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Categoria = Categoria::create($request->all());
        return response()->json(['message' => 'Categoria Cadastrado!'], 200);

    }

    public function update(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Categoria::$rules, Categoria::$messages);
        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Categoria = Categoria::find($request->id);
        if(!$Categoria) {
            return response()->json(['message' => 'Não foi encontrado Categoria com esse "id"!'], 404);
        }

        $Categoria->name = $request->name;
        $Categoria->save();
        return response()->json(['message' => 'Categoria Atualizada!'], 200);
    }



    public function delete(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $Categoria = Categoria::find($request->id);

        if(!$Categoria) {
            return response()->json(['message' => 'Não foi encontrado Categoria com esse "id"!'], 404);
        }

        $Categoria->delete();

        return response()->json(['message' => 'Categoria deletada com Sucesso!'], 200);
    }
}
