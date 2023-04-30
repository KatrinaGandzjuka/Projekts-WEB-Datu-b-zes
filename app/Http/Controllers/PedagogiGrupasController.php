<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedagogsGrupa_tabula;
use App\Models\Grupas_tabula;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class PedagogiGrupasController extends Controller
{
    function PievPedPedagogiGrupasIndex($GrupasNosaukums)
    {
        $LietotajsData = Lietotajs_tabula::where("LomaID", 3)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("pedagogsgrupa")
                    ->whereRaw("PedagogaPersonasKods = PersonasKods")
                    ->where("GrupasPedagogaNosaukums", $GrupasNosaukums);
            })
            ->get();
        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();
        return view("pievPedPedagogiGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }

    function PedagogiGrupasDataInsert(Request $request, $GrupasNosaukums)
    {
        $nodSk = $request->input("nodSk");
        $personasKods = $request->input("personasKods");

        $isPedagogiGrupasInsertSuccess = PedagogsGrupa_tabula::insert([
            "NodSk" => $nodSk,
            "PedagogaPersonasKods" => $personasKods,
            "GrupasPedagogaNosaukums" => $GrupasNosaukums,
        ]);
        if ($isPedagogiGrupasInsertSuccess) {
            echo '<script>alert("Pedagogs tika pievienots grupai ;)");</script>';
        } else {
            echo '<script>alert("Pedagogs netika pievienots grupai :(");</script>';
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

    function PedagogiGrupasDataDelete($GrupasNosaukums, $personasKods)
    {
        $isPedagogiGrupasDeleteSuccess = PedagogsGrupa_tabula::where([
            ["GrupasPedagogaNosaukums", "=", $GrupasNosaukums],
            ["PedagogaPersonasKods", "=", $personasKods],
        ])->delete();

        if ($isPedagogiGrupasDeleteSuccess) {
            echo '<script>alert("Pedagogs tika izdzēsts no grupas");</script>';
        } else {
            echo '<script>alert("Pedagogs netika izdzēsts no grupas");</script>';
        }

        $LietotajsData = Lietotajs_tabula::where("LomaID", 3)
            ->whereNotExists(function ($query) use ($GrupasNosaukums) {
                $query
                    ->select("*")
                    ->from("pedagogsgrupa")
                    ->whereRaw("PedagogaPersonasKods = PersonasKods")
                    ->where("GrupasPedagogaNosaukums", $GrupasNosaukums);
            })
            ->get();
        $LomasData = Lomas_tabula::all();
        $GrupasData = Grupas_tabula::all();
        return view("pievPedPedagogiGrupas", [
            "GrupasNosaukums" => $GrupasNosaukums,
            "LietotajsData" => $LietotajsData,
            "LomasData" => $LomasData,
        ]);
    }
}
