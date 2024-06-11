<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::guest()) {
            return view('index');
        }

        return redirect()->route('junta-panelas.index');
    }
}
