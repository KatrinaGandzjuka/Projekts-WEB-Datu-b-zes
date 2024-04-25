<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numurs;
use App\Models\Lietotajs_tabula;
use App\Models\Terpi_tabula;

class NumursController extends Controller
{
    public function index()
    {
        $numurs = Numurs::all();
        return view('viewNumuri', compact('numurs'));
    }

    public function create()
    {
        $pedagogs = Lietotajs_tabula::where('LomaID', 3)->get();
        $audzeknis = Lietotajs_tabula::where('LomaID', 1)->get();
        $kostims = Terpi_tabula::all();
        return view('addNumurs', compact('pedagogs', 'audzeknis', 'kostims'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nosaukums' => 'required|string',
            'garums' => 'required',
            'muzikas_nosaukums' => 'required|string',
            'pedagogs' => 'required|array',
            'audzeknis' => 'required|array',
            'kostims' => 'required|array',
        ]);

        $performance = Numurs::create($validated);

        $performance->pedagogs()->sync($request->pedagogs);
        $performance->audzeknis()->sync($request->audzeknis);
        $performance->kostims()->sync($request->kostims);

        return redirect()->route('viewNumuri')->with('success', 'Kostims tika pievienots');
    }

    public function edit($id)
    {
        $numurs = Numurs::findOrFail($id);
        $pedagogs = Lietotajs_tabula::where('LomaID', 3)->get();
        $audzeknis = Lietotajs_tabula::where('LomaID', 1)->get();
        $kostims = Terpi_tabula::all();

        return view('numurs.edit', compact('numurs', 'pedagogs', 'audzeknis', 'kostims'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nosaukums' => 'required|string',
            'garums' => 'required',
            'muzikas_nosaukums' => 'required|string',
            'pedagogs' => 'required|array',
            'audzeknis' => 'required|array',
            'kostims' => 'required|array',
        ]);

        $numurs = Numurs::findOrFail($id);
        $numurs->update($validated);

        $numurs->pedagogs()->sync($request->pedagogs);
        $numurs->audzeknis()->sync($request->audzeknis);
        $numurs->kostims()->sync($request->kostims);

        return redirect()->route('numurs.index')->with('success', 'Numurs tika izmainīts');
    }

    public function destroy($id)
    {
        $performance = Numurs::findOrFail($id);
        $performance->delete();

        return redirect()->route('numurs.index')->with('success', 'Numurs tika dzēsts');
    }
}


