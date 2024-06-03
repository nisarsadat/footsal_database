<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OwnerPickup extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = [
        'owner_id',
        'amount',
        'note',
        'date',


    ];



    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
