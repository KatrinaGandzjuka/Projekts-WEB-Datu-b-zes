<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lietotajs_tabula extends Model
{
    public $table = 'lietotajs';
    public $primaryKey = 'personasKods';
    public $incrementing = false;
    public $timestamps = false;
}
