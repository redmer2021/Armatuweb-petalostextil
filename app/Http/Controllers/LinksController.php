<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function PoliticasDeCambio(){
        return view('pgpolitcambios');
    }

    public function PreguntasFrecuentes(){
        return view('pgpreguntasfrec');
    }

}
