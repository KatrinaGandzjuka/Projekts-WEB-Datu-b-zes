<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomas_tabula extends Model
{
    public $table = 'loma';
    public $primaryKey = 'LomaID';
    public $incrementing = false;
    public $timestamps = false;
}
