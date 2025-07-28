<?php

namespace App\Models\HostFully;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFullyPropertyReview extends Model
{
    use HasFactory;

    public $fillable=[
        "uid" ,
"author" ,
"title" ,
"content" ,
"rating" ,
"date" ,
"propertyUid" ,
"leadUid" ,
"source" ,
"privateFeedback" ,
"reviewResponse" ,
"ratingCategories" ,
'property_uid',
'updatedUtcDateTime'
    ];
}
