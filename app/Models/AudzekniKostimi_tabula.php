<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudzekniKostimi_tabula extends Model
{
    public $table = 'audzeknikostimi';
    public $primaryKey = 'AudzKostID';
    public $incrementing = false;
    public $timestamps = false;
}
