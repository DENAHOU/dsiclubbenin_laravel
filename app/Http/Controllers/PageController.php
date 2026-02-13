<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function recrutement()
    {
        return view('pages.recrutement');
    }

    public function esn()
    {
        return view('pages.esn');
    }


}
