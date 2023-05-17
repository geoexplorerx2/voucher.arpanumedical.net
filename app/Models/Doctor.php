<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use SoftDeletes;
    protected $table = 'doctors';

    public function medicalDepartment()
    {
      return $this->belongsTo(MedicalDepartment::class, 'medical_department_id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
