<?php

namespace App\Models\HostFully;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFullyPropertyPricePeriod extends Model
{
    use HasFactory;
    public $fillable=[
"propertyUid" ,
"from_date" ,
"amount" ,
"minimumStay" ,
"isCheckinAllowed" ,
"isCheckoutAllowed" ,
'unavailable'
    ];
}
