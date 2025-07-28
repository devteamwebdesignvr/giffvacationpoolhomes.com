<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyPropertyPhoto extends Model{
    use HasFactory;
    public $fillable=["uid","description","url","displayOrder","airbnbRoomId",'property_uid',"originalImageUrl" ,"largeScaleImageUrl" ,"mediumScaleImageUrl" ,"largeThumbnailScaleImageUrl"];
}