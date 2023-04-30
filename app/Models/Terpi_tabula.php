<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terpi_tabula extends Model
{
    public $table = 'kostimi';
    public $primaryKey = 'KostimiID';
    public $incrementing = false;
    public $timestamps = false;
}
