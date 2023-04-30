<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupas_tabula extends Model
{
    public $table = 'grupa';
    public $primaryKey = 'GrupasNosaukums';
    public $incrementing = false;
    public $timestamps = false;
}
