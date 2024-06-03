<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'id',
        'name',
        'phone'

    ];




    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }





    // public static function boot(){

    //     parent::boot();
    //     static::deleting(function(Customer $customer){
    //         $customer->bookings()->delete();
    //     }



    // );




//     // static::restoring(function(Customer $customer){
//     //             $customer->bookings()->restore();
//     //         });


//     // }

// }
}






