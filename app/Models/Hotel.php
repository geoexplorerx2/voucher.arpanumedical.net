<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use SoftDeletes;
    protected $table = 'hotels';

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
