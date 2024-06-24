<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ParticipantController extends Controller
{
    public function index(): View
    {
        return view('junta-panelas.participants');
    }
}
