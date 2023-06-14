<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformInvoiceListModel extends Model
{
    use HasFactory;
    protected $table = "proformainvoice";
    protected $fillable = [
        'date',
        'gender',
        'fullname',
        'city',
        'perNight',
        'ReceiptNo',
        'surchargepayment',
        'surchargepaymentUnit',
        'surchargepayment2',
        'surchargepaymentUnit2',
        'DHI',
        'DHIUnit',
    ];
}
