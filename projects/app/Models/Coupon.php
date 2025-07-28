<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $table = "coupons";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'name',
		'description',
		'code',
		'amount',
		'type',
		'property_id',
		

    ];

    public static $rules = [
        // create rules
    ];

    // Cm 
}

