<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyPropertyAmenity extends Model{
    use HasFactory;
    public $fillable=["uid", "amenity","category","propertyUid","description",'property_uid'];
}