<?php

namespace App\Models;

// use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'hall_id',
        'price',
        'from',
        'to',
        'date',
        'discount',
        'stuffs_rent',
        'payed',
        'due',
        'total',
        'booking_name'

    ];



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }



}
