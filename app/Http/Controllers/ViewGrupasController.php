<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grupas_tabula;

class ViewGrupasController extends Controller
{
    function ViewGrupasIndex()
    {
        $GrupasData = Grupas_tabula::all();
        foreach ($GrupasData as $key => $gd) {
            $audzeknuSkaits = DB::table("audzeknisgrupa")
                ->join(
                    "grupa",
                    "audzeknisgrupa.GrupasAudzeknaNosaukums",
                    "=",
                    "grupa.GrupasNosaukums"
                )
                ->where("grupa.GrupasNosaukums", "=", $gd->GrupasNosaukums)
                ->count();
            $GrupasData[$key]->audzeknuSkaits = $audzeknuSkaits;
        }
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }

    function GrupasRedigetIndex($GrupasNosaukums)
    {
        $GrupasData = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->get();
        if (count($GrupasData) > 0) {
            return view("grupasRediget", ["gd" => $GrupasData[0]]);
        } else {
            return view("grupasRediget", ["gd" => null]);
        }
    }

    function DataUpdateGrupas(Request $request)
    {
        $GrupasNosaukums = $request->GrupasNosaukums;
        $Grafiks = $request->input("Grafiks");
        $Filiale = $request->input("Filiale");

        $isUpdateSuccess = Grupas_tabula::where(
            "GrupasNosaukums",
            $GrupasNosaukums
        )->update([
            "Grafiks" => $request->input("Grafiks"),
            "Filiale" => $request->input("Filiale"),
        ]);

        if ($isUpdateSuccess) {
            echo '<script>alert("Grupas dati veiksmīgi rediģēti ;)");</script>';
        } else {
            echo '<script>alert("Grupas dati netika rediģēti :(");</script>';
        }
        $GrupasData = Grupas_tabula::all();
        return view("viewGrupas", ["GrupasData" => $GrupasData]);
    }
}
