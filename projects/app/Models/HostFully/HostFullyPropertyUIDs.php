<?php

namespace App\Models\HostFully;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFullyPropertyUIDs extends Model
{
    use HasFactory;

    public $fillable=[
        "propertiesUid",
        "agency_uid"
    ];
}
