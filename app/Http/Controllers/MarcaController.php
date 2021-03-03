<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        $Marcas = Marca::all();
        return response()->json([
            'Marcas' => $Marcas
        ]);
    }


    public function create(Request $request)
    {

        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Marca::$rules, Marca::$messages);

        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Marca = Marca::create($request->all());
        return response()->json(['message' => 'Marca Cadastrado!'], 200);

    }

    public function update(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), Marca::$rules, Marca::$messages);
        if($validator->getMessageBag()->first()){
            return response()->json(['message' => $validator->getMessageBag()], 406);
        }

        $Marca = Marca::find($request->id);
        if(!$Marca) {
            return response()->json(['message' => 'Não foi encontrado Marca com esse "id"!'], 404);
        }

        $Marca->name = $request->name;
        $Marca->save();
        return response()->json(['message' => 'Marca Atualizada!'], 200);
    }



    public function delete(Request $request)
    {
        if (auth()->user()->admin != 1) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $Marca = Marca::find($request->id);

        if(!$Marca) {
            return response()->json(['message' => ['Não foi encontrado Marca com esse "id"!']], 404);
        }

        $Marca->delete();

        return response()->json(['message' => 'Marca deletada com Sucesso!'], 200);
    }

}
