<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function Producto($idProducto){
        return view('pgproducto');
    }

}
