<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCatagory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name',
    ];








    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }



}
