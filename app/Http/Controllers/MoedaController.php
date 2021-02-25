<?php

namespace App\Http\Controllers;

use App\Models\Moeda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoedaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function update(Request $request)
    {
        //
    }


    public function delete($id)
    {
        //
    }
}
