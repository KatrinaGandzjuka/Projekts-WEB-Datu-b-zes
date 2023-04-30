<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terpi_tabula;

class DeleteTerpiController extends Controller
{
    function DeleteTerpiIndex($KostimiID)
    {
        return view("deleteTerpi", ["KostimiID" => $KostimiID]);
    }

    function DeleteTerpiData($KostimiID)
    {
        $isDeleteSuccess = Terpi_tabula::where(
            "KostimiID",
            $KostimiID
        )->delete();

        if ($isDeleteSuccess) {
            echo '<script>alert("Kostīms tika izdzēsts");</script>';
        } else {
            echo '<script>alert("Kostīms netika izdzēsts");</script>';
        }
        $TerpiData = Terpi_tabula::all();
        return view("viewTerpi", ["TerpiData" => $TerpiData]);
    }
}
