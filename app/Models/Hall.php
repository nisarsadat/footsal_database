<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'size',

    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
