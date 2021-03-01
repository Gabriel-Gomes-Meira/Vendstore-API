<?php

namespace App\Http\Controllers;

use App\Models\Moeda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoedaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $Moedas = Moeda::all();
        return response(['Moedas' => $Moedas], 200);
    }


    public function create(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Moeda::$rules, Moeda::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        Moeda::create($request->all());
        return response()->json(['message' => 'Moeda Salva com sucesso!'], 200);
    }


    public function update(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Moeda::$rules, Moeda::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Moeda = Moeda::find($request->id);
        if(!$Moeda) {
            return response()->json(['message' => "Não encontrado moeda com este id ($request->id)! "], 404);
        }

        $Moeda->sigla = $request->sigla;
        $Moeda->pais = $request->pais;

        return response()->json(['message' => 'Moeda atualizada!'], 200);
    }


    public function delete($id)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $Moeda = Moeda::find($id);
        if(!$Moeda) {
            return response()->json(['message' => "Não encontrado moeda com este id ($id)! "], 404);
        }

        return response()->json(['message' => 'Registro deletado com sucesso!'], 200);
    }
}
