<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\City;

class Store extends Model
{
    public $table ='store';
    public $primaryKey='store_id';

    function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }
}
