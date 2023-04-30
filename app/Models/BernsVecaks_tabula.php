<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BernsVecaks_tabula extends Model
{
    public $table = 'bernsvecaks';
    public $primaryKey = 'BernsVecaksID';
    public $incrementing = false;
    public $timestamps = false;
}
