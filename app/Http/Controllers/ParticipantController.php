<?php

namespace App\Http\Controllers;

use App\Models\JuntaPanelas;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    public function index(JuntaPanelas $juntaPanelas): View
    {
        return view('junta-panelas.participants');
    }

    public function store(Request $request, JuntaPanelas $juntaPanelas): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'item_1' => ['string', 'max:100'],
            'item_2' => ['string', 'max:100'],
            'item_3' => ['string', 'max:100'],
            'item_4' => ['string', 'max:100'],
            'item_5' => ['string', 'max:100'],
        ]);

        $items = new Collection();
        if ($request->item_1) $items->add($request->item_1);
        if ($request->item_2) $items->add($request->item_2);
        if ($request->item_3) $items->add($request->item_3);
        if ($request->item_4) $items->add($request->item_4);
        if ($request->item_5) $items->add($request->item_5);

        if (empty($items)) {
            throw ValidationException::withMessages([
                'item_1' => 'O participante deve levar pelo menos 1 item.'
            ]);
        }

        $participant = new Participant();
        $participant->name = $request->name;
        $participant->items = $items->sort()->toArray();
        $juntaPanelas->participants()->attach($participant);

        return redirect()->route('participant.index', [
            'juntaPanelas' => $juntaPanelas,
        ]);
    }
}
