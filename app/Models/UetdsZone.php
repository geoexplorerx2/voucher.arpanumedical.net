<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UetdsZone extends Model
{
    use SoftDeletes;
    protected $table = 'uetds_zones';
}
