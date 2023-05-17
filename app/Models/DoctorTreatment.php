<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DoctorTreatment extends Model
{
    use SoftDeletes;
    protected $table = 'doctor_treatments';

    public function doctors()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function treatments()
    {
        return $this->belongsTo(Treatment::class,'treatment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
