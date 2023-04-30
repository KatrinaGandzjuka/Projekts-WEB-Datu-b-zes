<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AudzekniKostimi_tabula;
use App\Models\Terpi_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Grupas_tabula;

class AudzekniKostimiController extends Controller
{
    function AudzekniKostimiIndex($KostimiID)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($KostimiID) {
                $query
                    ->select("*")
                    ->from("audzeknikostimi")
                    ->whereRaw("AudzeknaKostimaPersonasKods = PersonasKods")
                    ->where("KostimiID", $KostimiID);
            })
            ->leftJoin(
                "audzeknisgrupa",
                "lietotajs.personasKods",
                "=",
                "audzeknisgrupa.AudzeknaGrupasPersonasKods"
            )
            ->get([
                "lietotajs.personasKods",
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "audzeknisgrupa.GrupasAudzeknaNosaukums",
            ]);
        $LomasData = Lomas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        return view("audzekniKostimi", [
            "KostimiID" => $KostimiID,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    function AudzekniKostimiDataInsert($KostimiID, $personasKods)
    {
        $date = date("Y-m-d");

        $isAudzekniKostimiInsertSuccess = AudzekniKostimi_tabula::insert([
            "PiesDatums" => $date,
            "AudzeknaKostimaPersonasKods" => $personasKods,
            "KostimiID" => $KostimiID,
        ]);
        if ($isAudzekniKostimiInsertSuccess) {
            return back()->with(["success" => true]);
        } else {
            return back()->with(["success" => false]);
        }
    }

    function AudzekniKostimiSavaktIndex($KostimiID)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereExists(function ($query) use ($KostimiID) {
                $query
                    ->select("*")
                    ->from("audzeknikostimi")
                    ->whereRaw("AudzeknaKostimaPersonasKods = PersonasKods")
                    ->where("KostimiID", $KostimiID);
            })
            ->leftJoin(
                "audzeknisgrupa",
                "lietotajs.personasKods",
                "=",
                "audzeknisgrupa.AudzeknaGrupasPersonasKods"
            )
            ->get([
                "lietotajs.personasKods",
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "audzeknisgrupa.GrupasAudzeknaNosaukums",
            ]);
        $LomasData = Lomas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        return view("audzekniKostimiSavakt", [
            "KostimiID" => $KostimiID,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    function AudzekniKostimiDataDelete($KostimiID, $personasKods)
    {
        $isAudzekniKostimiDeleteSuccess = AudzekniKostimi_tabula::where([
            ["KostimiID", "=", $KostimiID],
            ["AudzeknaKostimaPersonasKods", "=", $personasKods],
        ])->delete();

        if ($isAudzekniKostimiDeleteSuccess) {
            return back()->with(["success" => true]);
        } else {
            return back()->with(["success" => false]);
        }
    }

    function AudzekniKostimiGrupaIndex($KostimiID)
    {
        $GrupasData = Grupas_tabula::all();
        $KostimiData = Terpi_tabula::all();
        $audzekniKostimiData = AudzekniKostimi_tabula::all();
        return view("audzekniKostimiGrupas", [
            "KostimiID" => $KostimiID,
            "GrupasData" => $GrupasData,
            "audzekniKostimiData" => $audzekniKostimiData,
        ]);
    }
}
