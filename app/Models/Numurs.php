<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lietotajs_tabula; 
use App\Models\Terpi_tabula;

class Numurs extends Model
{
    protected $fillable = ['nosaukums', 'garums', 'muzikas_nosaukums'];

    public function pedagogs()
    {
        return $this->belongsToMany(Lietotajs_tabula::class, 'pedagogs_numurs', 'numurs_id', 'pedagogs_id');
    }

    public function audzeknis()
    {
        return $this->belongsToMany(Lietotajs_tabula::class, 'audzeknis_numurs', 'numurs_id', 'audzeknis_id');
    }

    public function kostims()
    {
        return $this->belongsToMany(Terpi_tabula::class, 'kostims_numurs', 'numurs_id', 'kostims_id');
    }
}
