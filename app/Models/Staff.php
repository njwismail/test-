<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Staff extends Model
{
    public $table='staff';
    public$primaryKey='staff_id';
    public $timestamps=false;

    //cannot see other people data
    public $hidden =['picture', 'password'];


    public store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
