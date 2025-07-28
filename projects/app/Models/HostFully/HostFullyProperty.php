<?php
namespace App\Models\HostFully;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HostFullyProperty extends Model{
    use HasFactory;
    public $fillable=["agency_uid","uid" ,"agencyUid" ,"name" ,"address1" ,"propertyType" ,"listingType" ,"roomType" ,"businessType" ,"isActive" ,"pictureLink" ,"webLink" ,"bedrooms" ,"beds" ,"bathrooms" ,"numberOfFloors" ,"rentalLicenseNumber" ,"rentalLicenseExpirationDate" ,"externalId" ,"accountingId" ,"showPropertyExactLocation" ,"agentUid" ,"wifiNetwork" ,"wifiPassword" ,"bookingNotes" ,"extraNotes" ,"ownerNotes" ,"cancellationPolicy" ,"useMinimumPriceRule" ,"integrationsData" ,"guideBookUrl" ,"guideBookRecsOnlyUrl" ,"updatedUtcDateTime" ,"address2" ,"postalCode" ,"city" ,"state" ,"longitude" ,"latitude" ,"countryCode" ,"area_unitType" ,"area_size" ,"baseGuests" ,"maxGuests" ,"minimumStay" ,"currency" ,"dailyRate" ,"all_data_json",'seo_url','meta_title','meta_keywords','meta_description','is_home','rental_aggrement_attachment','status',"bookng_widget","location_id"
    ];
}