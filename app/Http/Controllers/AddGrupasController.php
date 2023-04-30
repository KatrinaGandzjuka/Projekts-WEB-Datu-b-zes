<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupas_tabula;

class AddGrupasController extends Controller
{
    function IndexAddGrupas(){
        return view('addGrupas');
    }

    function GrupasDataInsert(Request $request){
        $GrupasNosaukums = $request->input('GrupasNosaukums');
        $Grafiks = $request->input('Grafiks');
        $Filiale = $request->input('Filiale');

        $isGrupasInsertSuccess = Grupas_tabula::insert([
            'GrupasNosaukums' => $request->input('GrupasNosaukums'),
            'Grafiks' => $request->input('Grafiks'),
            'Filiale' => $request->input('Filiale')
        ]);

        if($isGrupasInsertSuccess) {
            echo '<script>alert("Jauna grupa veiksmīgi pievienota ;)");</script>';
        } else {
            echo '<script>alert("Jauna grupa netika pievienota :(");</script>';
        }
        
        return view('addGrupas');
    }
}


