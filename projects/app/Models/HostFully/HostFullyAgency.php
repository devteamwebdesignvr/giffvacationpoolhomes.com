<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyAgency extends Model{
    use HasFactory;
    public $fillable=["uid","name","agencyEmailAddress","phoneNumber","website","address1","city","zipCode","state","currency","currencyCode","countryCode","defaultCheckInTime","defaultCheckOutTime","rentalCondition",
    ];
}