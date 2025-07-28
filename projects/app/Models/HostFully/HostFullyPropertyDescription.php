<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyPropertyDescription extends Model{
    use HasFactory;
      public $fillable=["property_uid","name","shortSummary","summary","notes","access","interaction","neighbourhood","space","houseManual","locale","transit",'propertyUid'];
}