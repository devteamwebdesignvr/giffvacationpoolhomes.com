<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyPropertyCustomAmenity extends Model{
    use HasFactory;
    public $fillable=["property_uid","uid","name","objectType","objectUid"];
}