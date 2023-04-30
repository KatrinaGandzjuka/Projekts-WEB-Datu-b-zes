<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Grupas_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class AudzekniGrupasController extends Controller
{
    function AudzekniGrupasIndex($GrupasNosaukums)
    {
        $LietotajsData = Lietotajs_tabula::whereIn("LomaID", [1, 3])
            ->where(function ($query) use ($GrupasNosaukums) {
                $query
                    ->whereExists(function ($subquery) use ($GrupasNosaukums) {
                        $subquery
                            ->select("*")
                            ->from("audzeknisgrupa")
                            ->whereRaw(
                                "AudzeknaGrupasPersonasKods = personasKods"
                            )
                            ->where(
                                "GrupasAudzeknaNosaukums",
                                $GrupasNosaukums
                            );
                    })
                    ->orWhereExists(function ($subquery) use (
                        $GrupasNosaukums
                    ) {
                        $subquery
                            ->select("*")
                            ->from("pedagogsgrupa")
                            ->whereRaw("PedagogaPersonasKods = personasKods")
                            ->where(
                                "GrupasPedagogaNosaukums",
                                $GrupasNosaukums
                            );
                    });
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("audzekniGrupas", [
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
            "GrupasNosaukums" => $GrupasNosaukums,
            "GrupasData" => $GrupasData,
        ]);
    }

    function PievAudzAudzekniGrupasIndex($GrupasNosaukums)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("audzeknisgrupa")
                    ->whereRaw("AudzeknaGrupasPersonasKods = PersonasKods")
                    ->where("GrupasAudzeknaNosaukums", $GrupasNosaukums);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("pievAudzAudzekniGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }
    function AudzekniGrupasDataInsert($GrupasNosaukums, $personasKods)
    {
        $date = date("Y-m-d");
        $isAudzekniGrupasInsertSuccess = AudzeknisGrupa_tabula::insert([
            "PienDatums" => $date,
            "AudzeknaGrupasPersonasKods" => $personasKods,
            "GrupasAudzeknaNosaukums" => $GrupasNosaukums,
        ]);

        if ($isAudzekniGrupasInsertSuccess) {
            echo '<script>alert("Audzēknis tika pievienots grupai ;)");</script>';
        } else {
            echo '<script>alert("Audzēknis netika pievienots grupai :(");</script>';
        }

        $LietotajsData = Lietotajs_tabula::whereIn("LomaID", [1, 3])
            ->where(function ($query) use ($GrupasNosaukums) {
                $query
                    ->whereExists(function ($subquery) use ($GrupasNosaukums) {
                        $subquery
                            ->select("*")
                            ->from("audzeknisgrupa")
                            ->whereRaw(
                                "AudzeknaGrupasPersonasKods = personasKods"
                            )
                            ->where(
                                "GrupasAudzeknaNosaukums",
                                $GrupasNosaukums
                            );
                    })
                    ->orWhereExists(function ($subquery) use (
                        $GrupasNosaukums
                    ) {
                        $subquery
                            ->select("*")
                            ->from("pedagogsgrupa")
                            ->whereRaw("PedagogaPersonasKods = personasKods")
                            ->where(
                                "GrupasPedagogaNosaukums",
                                $GrupasNosaukums
                            );
                    });
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("audzekniGrupas", [
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
            "GrupasNosaukums" => $GrupasNosaukums,
            "GrupasData" => $GrupasData,
        ]);
    }
    function AudzekniGrupasDataDelete($GrupasNosaukums, $personasKods)
    {
        $isAudzekniGrupasDeleteSuccess = AudzeknisGrupa_tabula::where([
            ["GrupasAudzeknaNosaukums", "=", $GrupasNosaukums],
            ["AudzeknaGrupasPersonasKods", "=", $personasKods],
        ])->delete();

        if ($isAudzekniGrupasDeleteSuccess) {
            echo '<script>alert("Audzēknis tika izdzēsts no grupas");</script>';
        } else {
            echo '<script>alert("Audzēknis netika izdzēsts no grupas");</script>';
        }
        $LietotajsData = Lietotajs_tabula::where("LomaID", 1)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("audzeknisgrupa")
                    ->whereRaw("AudzeknaGrupasPersonasKods = PersonasKods")
                    ->where("GrupasAudzeknaNosaukums", $GrupasNosaukums);
            })
            ->get();

        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();

        return view("pievAudzAudzekniGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }
}
