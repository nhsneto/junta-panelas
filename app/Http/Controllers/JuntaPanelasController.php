<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class JuntaPanelasController extends Controller
{
    public function index(Request $request): View
    {
        return view('junta-panelas.index', [
            'user' => $request->user(),
        ]);
    }

    public function create(Request $request): View
    {
        return view('junta-panelas.create');
    }
}
