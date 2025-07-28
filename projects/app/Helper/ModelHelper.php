<?php 
namespace App\Helper;
use App\Models\BasicSetting;
use DB;
use Auth;
use Mail;
use App\Models\EmailTemplete;
use App\Models\User;
use MailHelper;
use Session;
use LiveCart;
use Helper;
use App\Models\PropertyGallery;
use App\Models\Blogs\BlogCategory;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyRate;
use App\Models\BookingRequest;
use App\Models\Payment;
use App\Models\Cms;
/**
 * Class ModelHelper
 * @package App\Helper
 */
class ModelHelper{
   
    function finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property){
        $new_amount_data=[];
        $status_payment='partially';
        $i=Payment::where(['booking_id'=>$booking->id])->count();           
        BookingRequest::find($id)->update(["booking_status"=>"booking-confirmed","payment_status"=>$status_payment,"how_many_payment_done"=>$i]);
        $data=BookingRequest::Find($id);
        $html= view("mail.booking-first-admin",compact("property","data","payment"))->render();
        $to=ModelHelper::getDataFromSetting('payment_receiving_mail');
        $admin_subject="Booking Confirmation  for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject);
        $html= view("mail.booking-first-customer",compact("property","data","payment"))->render();
        $to=$data->email;
        $admin_subject="Booking Confirmation for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject);
    }
    
    function getImageByProduct($product_id){
        return PropertyGallery::where("property_id",$product_id)->orderBy("sorting","asc")->get();
    }

    function getBlogCategoriesSelect(){
        $data=[];
        $all=BlogCategory::all();
        foreach($all as $a){
            $data[$a->id]=$a->title;
        }
        return $data;
    }

    function saveSIngleDatePropertyRate($request,$id='default'){
        PropertyRate::where("rate_group_id",$id)->delete();
        if($request->start_date){
          $now = strtotime($request->start_date); // or your date as well
          $your_date = strtotime($request->end_date);
          $datediff =  $your_date-$now;
          $day= ceil($datediff / (60 * 60 * 24));
          for($i=0;$i<=$day;$i++){
            $data=$request->only([
                            "discount_weekly",
                            "discount_monthly",
                            "is_available",
                            "platform_type",
                            "currency",
                            "base_price",
                            "notes",
                            "min_stay",
                            "base_min_stay",
                            'property_id',
                            'checkin_day',
                            'checkout_day'
                        ]);
                $data['rate_group_id']=$id;
                $date = strtotime($request->start_date);
                $date = strtotime("+".$i." day", $date);
                $date= date('Y-m-d', $date);
                $data['single_date_timestamp']=strtotime($date);
                $data["single_date"]=$date;
                if($request->type_of_price=="default"){
                    $data['price']=$request->price;
                }else{
                    $newDay = date('l', strtotime($date));
                    if($newDay=="Monday"){
                        $data['price']=$request->monday_price;
                    }else if($newDay=="Tuesday"){
                        $data['price']=$request->tuesday_price;
                    }else if($newDay=="Wednesday"){
                        $data['price']=$request->wednesday_price;
                    }else if($newDay=="Thursday"){
                        $data['price']=$request->thrusday_price;
                    }else if($newDay=="Friday"){
                        $data['price']=$request->friday_price;
                    }else if($newDay=="Saturday"){
                        $data['price']=$request->saturday_price;
                    }else if($newDay=="Sunday"){
                        $data['price']=$request->sunday_price;
                    }
                }
                PropertyRate::create($data);
           }
        }
    }
    
    function showPetFee($pet_fee){
        if($pet_fee){
            if($pet_fee>0){
                return "display:block;";
            }
        }
        return "display:none;";
    }

    function getProperptySelectList(){
        $data=[];
        $all=Property::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }

    function getLocationSelectList(){
        $data=[];
        $all=Location::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }

    function getPageSelectList(){
        $data=[];
        $all=Cms::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }

    function getProppertySelectList(){
        $data=[];
        $all=Property::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }
	
	public function getDataFromSetting($name){
		$result=null;
		$data=BasicSetting::where("name",$name)->first();
		if($data){
			$result=$data->value;
		}
		return $result;
	}	
}