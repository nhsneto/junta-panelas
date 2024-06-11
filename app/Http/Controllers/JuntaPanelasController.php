<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class JuntaPanelasController extends Controller
{
    public function index(Request $request): View
    {
        return view('junta-panelas/dashboard', [
            'user' => $request->user(),
        ]);
    }
}
