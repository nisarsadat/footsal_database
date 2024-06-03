<?php

namespace App\Models;
// use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[

        'booking_id',
        'payed',
        'date'

    ];



    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
