<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupas_tabula;

class DeleteGrupasController extends Controller
{
    function DeleteGrupasIndex($GrupasNosaukums)
    {
        return view("deleteGrupas", ["GrupasNosaukums" => $GrupasNosaukums]);
    }

    function DeleteGrupasData($GrupasNosaukums)
    {
        $isDeleteSuccess = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Grupa tika izdzēsta");</script>';
        } else {
            echo '<script>alert("Grupa netika izdzēsta");</script>';
        }
        $GrupasData = Grupas_tabula::all();
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }
}
