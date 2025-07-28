<?php

namespace App\Models\HostFully;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFullyPropertyExternalCalender extends Model
{
    use HasFactory;
     public $fillable=[
        "property_uid",
      

        "url",
        "source",
        "name",
    ];
}
