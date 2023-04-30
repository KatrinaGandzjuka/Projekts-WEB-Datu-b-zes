<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;

class AdminController extends Controller
{
    function AdminIndex()
    {
        return view("admin");
    }

    function UserDataInsert(Request $request)
    {
        $personasKods = $request->input("personasKods");
        $Vards = $request->input("Vards");
        $Uzvards = $request->input("Uzvards");
        $Epasts = $request->input("Epasts");
        $Parole = $request->input("Parole");
        $Talrunis = $request->input("Talrunis");
        $dzimDiena = $request->input("dzimDiena");
        $LomaID = $request->input("LomaID");

        $isInsertSuccess = Lietotajs_tabula::insert([
            "personasKods" => $request->input("personasKods"),
            "Vards" => $request->input("Vards"),
            "Uzvards" => $request->input("Uzvards"),
            "Epasts" => $request->input("Epasts"),
            "Parole" => $request->input("Parole"),
            "Talrunis" => $request->input("Talrunis"),
            "dzimDiena" => $request->input("dzimDiena"),
            "LomaID" => $request->input("LomaID"),
        ]);

        if ($isInsertSuccess) {
            echo '<script>alert("Jauns lietotājs veiksmīgi pievienots ;)");</script>';
        } else {
            echo '<script>alert("Jauns lietotājs netika pievienots :(");</script>';
        }
        return view("admin");
    }
}
