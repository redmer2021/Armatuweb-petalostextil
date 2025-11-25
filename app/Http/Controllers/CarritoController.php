<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    public function recibirPagos(Request $request){
        Log::info(json_encode($request->all()));
    }

    public function finalizarCompra(){
        return view('pgfinalizarcompra');
    }

}
