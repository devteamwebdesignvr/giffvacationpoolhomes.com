<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_fully_properties', function (Blueprint $table) {
            $table->id();
             $table->string("agency_uid")->nullable();



            $table->string("pricingRules")->nullable();
          $table->string("bedCount")->nullable();
          $table->longText("bedTypes")->nullable();
          $table->string("type")->nullable();
          $table->string("name")->nullable();
          $table->string("isActive")->nullable();
          $table->string("baseGuests")->nullable();
          $table->string("maximumGuests")->nullable();
          $table->string("baseDailyRate")->nullable();
          $table->string("city")->nullable();
          $table->string("state")->nullable();
          $table->string("address1")->nullable();
          $table->string("address2")->nullable();
          $table->string("postalCode")->nullable();
          $table->string("countryCode")->nullable();
          $table->string("bedrooms")->nullable();
          $table->string("bathrooms")->nullable();
          $table->longText("picture")->nullable();
          $table->longText("webLink")->nullable();
          $table->string("cleaningFeeAmount")->nullable();
          $table->string("minimumStay")->nullable();
          $table->string("maximumStay")->nullable();
          $table->string("securityDepositAmount")->nullable();
          $table->string("externalID")->nullable();
          $table->string("acceptInstantBook")->nullable();
          $table->string("acceptBookingRequest")->nullable();
          $table->text("availabilityCalendarUrl")->nullable();
          $table->text("rentalCondition")->nullable();
          $table->text("cancellationPolicy")->nullable();
          $table->string("floor")->nullable();
          $table->string("areaSize")->nullable();
          $table->string("areaSizeUnit")->nullable();
          $table->double("extraGuestFee")->nullable();
          $table->double("taxationRate")->nullable();
          $table->double("latitude")->nullable();
          $table->double("longitude")->nullable();
          $table->string("airBnBID")->nullable();
          $table->string("homeAwayID")->nullable();
          $table->string("currency")->nullable();
          $table->string("currencySymbol")->nullable();
          $table->text("panoramicDataUrl")->nullable();
          $table->text("propertyURL")->nullable();
          $table->text("guideBookUrl")->nullable();
          $table->string("weekEndRatePercentAdjustment")->nullable();
          $table->string("bookingWindow")->nullable();
          $table->string("bookingWindowAfterCheckout")->nullable();
          $table->string("turnOverDays")->nullable();
          $table->string("bookingLeadTime")->nullable();
          $table->string("defaultCheckinTime")->nullable();
          $table->string("defaultCheckoutTime")->nullable();
          $table->string("wifiNetwork")->nullable();
          $table->string("wifiPassword")->nullable();
          $table->string("rentalLicenseNumber")->nullable();
          $table->string("rentalLicenseNumberExpirationDate")->nullable();
          $table->string("minimumWeekendStay",10);
          $table->longText("reviews")->nullable();
          $table->string("createdDate")->nullable();
          $table->string("percentUponReservation",10);
          $table->string("fullPaymentTiming")->nullable();
          $table->longText("listingLinks")->nullable();
          $table->string("uid",50);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('host_fully_properties');
    }
};
