<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use SoftDeletes;
    protected $table = 'vouchers';

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
