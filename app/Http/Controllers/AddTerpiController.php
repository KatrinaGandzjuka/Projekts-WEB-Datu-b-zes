<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terpi_tabula;

class AddTerpiController extends Controller
{
    function IndexAddTerpi(){
        return view('addTerpi');
    }

    function TerpiDataInsert(Request $request){
        $Nosaukums = $request->input('Nosaukums');
        $Krasa = $request->input('Krasa');
        $Izmers = $request->input('Izmers');
        $Attels = $request->file('Attels'); 

        if ($Attels) {
            $imageData = file_get_contents($Attels->getRealPath());
            $base64 = base64_encode($imageData);
        } else {
            $base64 = null;
        }
    

        $isTerpiInsertSuccess = Terpi_tabula::insert([
            'Nosaukums' => $request->input('Nosaukums'),
            'Krasa' => $request->input('Krasa'),
            'Izmers' => $request->input('Izmers'),
            'Attels' => $base64,
        ]);

        if($isTerpiInsertSuccess) echo '<script>alert("Jauns kostīms veiksmīgi pievienots ;)");</script>';
        else echo '<script>alert("Jauns kostīms netika pievienots :(");</script>';
        return view('addTerpi');
    }
}

