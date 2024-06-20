<?php

namespace App\Http\Controllers;

use App\Models\JuntaPanelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JuntaPanelasController extends Controller
{
    public function index(Request $request): View
    {
        return view('junta-panelas.index', [
            'user' => $request->user(),
            'juntaPanelasList' => $request->user()->juntaPanelas,
        ]);
    }

    public function show(Request $request): View
    {
        return view('junta-panelas.show');
    }

    public function create(Request $request): View
    {
        return view('junta-panelas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'after_or_equal:' . now()->format('Y-m-d')],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $timestamp = strtotime($request->date . $request->time);
        $date = date('c', $timestamp); // ISO 8601

        JuntaPanelas::create([
            'title' => $request->title,
            'date' => $date,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('junta-panelas.index');
    }

    public function edit(Request $request): View
    {
        return view('junta-panelas.edit');
    }

    public function participants(Request $request): View
    {
        return view('junta-panelas.participants');
    }
}
