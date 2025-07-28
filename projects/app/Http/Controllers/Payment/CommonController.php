<?php
namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Payment;
use App\Models\HostFully\HostFullyProperty;
use Session;
use ModelHelper;
use MailHelper;

class CommonController extends Controller
{
    function showReceipt(Request $request ,$id){
        $payment=Payment::find($id);
        if($payment){
            $booking=BookingRequest::find($payment->booking_id);
            if($booking){
                $property=HostFullyProperty::find($booking->property_id);
                if($property){
                    $data = new \stdClass();
                    $data->name="Booking Confirmation ";
                    $data->meta_title="Booking Confirmation ";
                    $data->meta_keywords="Booking Confirmation ";
                    $data->meta_description="Booking Confirmation ";
                    $booking=$booking->toArray();
                    return view("front.booking.payment.first-preview",compact("booking","data","property","payment"));
                }
            }
        }
        return abort(404);
    }
}