<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esn;

class PageController extends Controller
{
    public function recrutement()
    {
        return view('pages.recrutement');
    }

    public function esn()
    {
        $esns = Esn::latest()->simplePaginate(9);
        return view('pages.esn', compact('esns'));

    }


}
