<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index () {
        // return response()->json(['categorias' => Categoria::all()]);

        return new CategoriaCollection(Categoria::all());
    }
}
