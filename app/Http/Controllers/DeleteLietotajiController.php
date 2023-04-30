<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lietotajs_tabula;
use App\Models\Lomas_tabula;

class DeleteLietotajiController extends Controller
{
    function DeleteLietotajiIndex($personasKods){
        return view('deleteLietotaji', ['personasKods'=>$personasKods]);
    }

    function DeleteLietotajiData($personasKods){
        //return $personasKods;
        $isDeleteSuccess = Lietotajs_tabula::where('personasKods', $personasKods)->delete();

        if($isDeleteSuccess) echo '<script>alert("Lietotājs tika izdzēsts");</script>';
        else echo '<script>alert("Lietotājs netika izdzēsts");</script>';
        $LietotajsData = Lietotajs_tabula::all();
        $LomasData = Lomas_tabula::all();
        return view('viewLietotaji', ['LietotajsData'=> $LietotajsData], ['LomasData'=> $LomasData]);
    }
}
