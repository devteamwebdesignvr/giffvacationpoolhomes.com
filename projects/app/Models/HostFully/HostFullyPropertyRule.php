<?php

namespace App\Models\HostFully;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFullyPropertyRule extends Model
{
    
     public $table = "host_fully_property_rules";
    use HasFactory;
     public $fillable=[
        "uid",
      

        "rule",
        "propertyUid",
        "description",
    ];
}
