<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;
use App\Models\Grupas_tabula;
use App\Models\AudzeknisGrupa_tabula;
use App\Models\Terpi_tabula;
use App\Models\BernsVecaks_tabula;

class LoginController extends Controller
{
    function LoginIndex()
    {
        return view("login");
    }

    function LoginPost(Request $request)
    {
        $personasKods = $request->input("personasKods");
        $parole = $request->input("Parole");

        $lietotajs = Lietotajs_tabula::where("personasKods", $personasKods)
            ->where("parole", $parole)
            ->first();

        if ($lietotajs) {
            session([
                "personasKods" => $personasKods,
                "LomaID" => $lietotajs->LomaID,
            ]);
            echo '<script>alert(" ;) ");</script>';
            switch (session("LomaID")) {
                case 0:
                    return view("admin");
                    break;
                case 1:
                    return $this->AudzeknisIndex($personasKods);
                    break;
                case 2:
                    return $this->VecaksIndex($personasKods);
                    break;
                case 3:
                    return $this->PedagogsIndex($personasKods);
                    break;
            }
        } else {
            echo '<script>alert(" :( Pārbaudiet personas kodu un paroli");</script>';
            return view("login");
        }
    }

    function AudzeknisIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where("personasKods", $personasKods)
            ->whereIn("personasKods", function ($query) use ($personasKods) {
                $query
                    ->select("AudzeknaGrupasPersonasKods")
                    ->from("audzeknisgrupa")
                    ->where("AudzeknaGrupasPersonasKods", $personasKods);
            })
            ->get();

        $GrupasData = Grupas_tabula::join(
            "audzeknisgrupa",
            "grupa.GrupasNosaukums",
            "=",
            "audzeknisgrupa.GrupasAudzeknaNosaukums"
        )
            ->join("filiale", "grupa.Filiale", "=", "filiale.Filiale")
            ->where("audzeknisgrupa.AudzeknaGrupasPersonasKods", $personasKods)
            ->select(
                "grupa.*",
                "filiale.Valsts",
                "filiale.Pilseta",
                "filiale.Rajons",
                "filiale.Iela",
                "filiale.Eka",
                "filiale.Indekss"
            )
            ->distinct()
            ->get();

        $PedagogsData = Lietotajs_tabula::where("LomaID", 3)
            ->where(function ($query) use ($GrupasData) {
                foreach ($GrupasData as $grupa) {
                    $GrupasNosaukums = $grupa->GrupasNosaukums;
                    $query->orWhereExists(function ($subquery) use (
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
                }
            })
            ->get();

        $TerpiData = Terpi_tabula::join(
            "audzeknikostimi",
            "kostimi.KostimiID",
            "=",
            "audzeknikostimi.KostimiID"
        )
            ->where(
                "audzeknikostimi.AudzeknaKostimaPersonasKods",
                $personasKods
            )
            ->select("kostimi.*", "audzeknikostimi.PiesDatums")
            ->get();

        $VecaksData = BernsVecaks_tabula::join(
            "lietotajs",
            "bernsvecaks.VecakaPersonasKods",
            "=",
            "lietotajs.personasKods"
        )
            ->where("bernsvecaks.BernaPersonasKods", $personasKods)
            ->get([
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "lietotajs.personasKods",
                "lietotajs.Talrunis",
                "lietotajs.Epasts",
                "lietotajs.DzimDiena",
            ]);

        if (count($LietotajsData) > 0) {
            return view("audzeknis", [
                "ld" => $LietotajsData[0],
                "GrupasData" => $GrupasData,
                "PedagogsData" => $PedagogsData,
                "TerpiData" => $TerpiData,
                "VecaksData" => $VecaksData,
            ]);
        } else {
            return view("audzeknis", [
                "ld" => null,
                "GrupasData" => $GrupasData,
                "PedagogsData" => $PedagogsData,
                "TerpiData" => $TerpiData,
                "VecaksData" => $VecaksData,
            ]);
        }
    }

    function VecaksIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where(
            "personasKods",
            $personasKods
        )->get();

        $BernsData = BernsVecaks_tabula::join(
            "lietotajs",
            "bernsvecaks.BernaPersonasKods",
            "=",
            "lietotajs.personasKods"
        )
            ->where("bernsvecaks.VecakaPersonasKods", $personasKods)
            ->get([
                "lietotajs.Vards",
                "lietotajs.Uzvards",
                "lietotajs.personasKods",
                "lietotajs.Talrunis",
                "lietotajs.Epasts",
                "lietotajs.DzimDiena",
            ]);

        if (count($LietotajsData) > 0) {
            return view("vecaks", [
                "ld" => $LietotajsData[0],
                "BernsData" => $BernsData,
            ]);
        } else {
            return view("vecaks", ["ld" => null]);
        }
    }

    function PedagogsIndex($personasKods)
    {
        $LietotajsData = Lietotajs_tabula::where(
            "personasKods",
            $personasKods
        )->get();

        $GrupasData = Grupas_tabula::join(
            "pedagogsgrupa",
            "grupa.GrupasNosaukums",
            "=",
            "pedagogsgrupa.GrupasPedagogaNosaukums"
        )
            ->join("filiale", "grupa.Filiale", "=", "filiale.Filiale")
            ->where("pedagogsgrupa.PedagogaPersonasKods", $personasKods)
            ->select(
                "grupa.*",
                "filiale.Valsts",
                "filiale.Pilseta",
                "filiale.Rajons",
                "filiale.Iela",
                "filiale.Eka",
                "filiale.Indekss"
            )
            ->distinct()
            ->get();

        $AudzeknisData = Lietotajs_tabula::where("LomaID", 1)
            ->where(function ($query) use ($GrupasData) {
                foreach ($GrupasData as $grupa) {
                    $GrupasNosaukums = $grupa->GrupasNosaukums;
                    $query->orWhereExists(function ($subquery) use (
                        $GrupasNosaukums
                    ) {
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
                    });
                }
            })
            ->get();

        $TerpiData = Terpi_tabula::all();

        if (count($LietotajsData) > 0) {
            return view("pedagogs", [
                "ld" => $LietotajsData[0],
                "GrupasData" => $GrupasData,
                "AudzeknisData" => $AudzeknisData,
                "TerpiData" => $TerpiData,
            ]);
        } else {
            return view("pedagogs", [
                "ld" => null,
                "GrupasData" => $GrupasData,
                "AudzeknisData" => $AudzeknisData,
                "TerpiData" => $TerpiData,
            ]);
        }
    }
}
