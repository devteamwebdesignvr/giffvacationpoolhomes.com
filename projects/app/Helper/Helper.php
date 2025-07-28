<?php 
namespace App\Helper;
use App\Models\Agent;
use Auth;
use DB;
use File;
use HostFully;
use ModelHelper;
use LiveCart;
use App\Models\BasicSetting;
use App\Models\PropertyRate;
use App\Models\Property;
use Session;
/**
 * Class Helper
 * @package App\Helper
 */
class Helper{

	function camelCaseToSnakeCase($str) {
		$snakeCase = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $str));
		$snakeCase=str_replace("_"," ",$snakeCase);
		$snakeCase=str_replace("is","",$snakeCase);
		$snakeCase=str_replace("has","",$snakeCase);
		$snakeCase=ucwords($snakeCase);
		return $snakeCase;
	}
    
    function deleteFile($file){
        if($file){
            $image_path = public_path("{$file}");
            if (File::exists($image_path)) {
                //File::delete($image_path);
                //unlink($image_path);
            }
        }
    }

	function calculateDays($start_date,$end_date){
		$now = strtotime($start_date); // or your date as well
		$your_date = strtotime($end_date);
		$datediff =  $your_date-$now;
		$day= ceil($datediff / (60 * 60 * 24));
		return $day;
	}

	function getBookingStatus($item,$id){
		if($item=="booked"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-primary">Accept Booking</a>';
		}
		if($item=="rental-aggrement-success"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-warning">Booking Accepted</a>';
		}
		if($item=="rental-aggrement"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-warning">Booking Accepted</a>';
		}
		if($item=="booking-confirmed"){
			$s='<a href="javascript:;" class="btn btn-xs btn-success">Booking Confirmed</a>';
		}
		if($item=="booking-cancel"){
			$s='<a href="javascript:;" class="btn btn-xs btn-danger">Booking Cancelled</a>';
		}
		return $s;
	}

	function checkStatus($item){
		if($item=="true"){
			return '<i class="fa fa-check"></i>';
		}else{
			return '<i class="fa fa-times"></i>';
		}
	}

	function getDayBetweenTwoDates($start_date,$end_date){
		$now = strtotime($start_date); 
		$your_date = strtotime($end_date);
		$datediff =  $your_date-$now;
		$day= ceil($datediff / (60 * 60 * 24));
          return $day;
	}

	function getFeeAmountAndName($c,$gross_amount){
		$name=$c->fee_name;
        if($c->fee_type=="Percentage"):
            $name.='('.$c->fee_rate.'%)';
            $amount=round(($gross_amount*$c->fee_rate)/100,2);
        else:
            $amount=$c->fee_rate; 
        endif;
        return ["status"=>true,"name"=>$name,"amount"=>$amount];
	}

	function getPropertyRates($id){
		$ar=PropertyRate::where(["property_id"=>$id])->orderBy("id","desc")->get();
		$ar_checkin_checkout=LiveCart::iCalDataCheckInCheckOut($id);
		$new_dates=[];
		$payment_currency=ModelHelper::getDataFromSetting('payment_currency');
		$property=Property::find($id);
		$price='';
		if($property){
		    $price=$property->standard_rate;
		}
		for($i=0;$i<=365;$i++){
		     $title=$payment_currency.''.$price;
		    $class="available-date-full-calendar";
		    $date_single=date('Y-m-d',strtotime("+ ".$i."days",strtotime(date('Y-m-d'))));
		    $a=PropertyRate::where(["property_id"=>$id])->where("single_date",$date_single)->orderBy("id","desc")->first();
		    if($a){
		        $title=$payment_currency.''.$a->price;
		    }
			if(in_array($date_single, $ar_checkin_checkout['checkin'])){
				$title='';
				$class="booked-date-full-calendar";
			}
			if(in_array($date_single, $ar_checkin_checkout['checkout'])){
				$title='';
				$class="booked-date-full-calendar";
			}
		    $new_dates[]=["title"=>$title,"start"=>$date_single,"end"=>$date_single,"className"=>$class];
		}
		return json_encode($new_dates);
	}

	function getGrossAmountData($property,$start_date,$end_date){
		$status=false;
		$gross_amount=0;
		$message='';
		$stay_flag=0;
		$day_gaurav=$this->getWeekNameSelect();
		$now = strtotime($start_date); 
          $your_date = strtotime($end_date);
          $datediff =  $your_date-$now;
          $day= ceil($datediff / (60 * 60 * 24));
         $total_night=$day;
         if($day>0){
             if($property){
		         for($i=0;$i<$day;$i++){
		         	$date = strtotime($start_date);
		            $date = strtotime("+".$i." day", $date);
		            $date= date('Y-m-d', $date);
		            $rate=PropertyRate::where(["property_id"=>$property->id,"single_date"=>$date])->first();
		            if($rate){
		            	$stay_flag=1;
		            	if($rate->min_stay<=$day){
		            	    if($i==0){
		            	        if(in_array($rate->checkin_day,['0','1','2','3','4','5','6'])){
		            	            $new_day=(date('w', strtotime($date)));
		            	            if($new_day==$rate->checkin_day){}else{
		            	                $status='checkin-checkout-day';
		            	                $message="Please select checkin  day is ".$day_gaurav[$rate->checkin_day];
		            	                break;
		            	            }
		            	        }
		            	    }
		            	    if($i==($day-1)){
		            	        if(in_array($rate->checkout_day,['0','1','2','3','4','5','6'])){
		            	            $new_day=(date('w', strtotime("+1 day",strtotime($date))));
		            	            if($new_day==$rate->checkout_day){}else{
		            	                $status='checkin-checkout-day';
		            	                $message="Please select checkout  day is ".$day_gaurav[$rate->checkout_day];
		            	                break;
		            	            }
		            	        }
		            	    }
		            		if($rate->price){
			            		$gross_amount+=$rate->price;
			            		$status=true;
			            	}
		            	}else{
		            		$status='min-stay-day';
		            		break;
		            	}
		            }else{
		            	if($property->standard_rate){
		            	     if($i==0){
		            	        if(in_array($property->checkin_day,['0','1','2','3','4','5','6'])){
		            	            $new_day=(date('w', strtotime($date)));
		            	            if($new_day==$property->checkin_day){}else{
		            	                $status='checkin-checkout-day';
		            	                $message="Please select checkin  day is ".$day_gaurav[$property->checkin_day];
		            	                break;
		            	            }
		            	        }
		            	    }
		            	    if($i==($day-1)){
		            	        if(in_array($property->checkout_day,['0','1','2','3','4','5','6'])){
		            	            $new_day=(date('w', strtotime("+1 day",strtotime($date))));
		            	            if($new_day==$property->checkout_day){ }else{
		            	                $status='checkin-checkout-day';
		            	                $message="Please select checkout  day is ".$day_gaurav[$property->checkout_day];
		            	                break;
		            	            }
		            	        }
		            	    }
		            		$gross_amount+=$property->standard_rate;
		            		$status=true;
		            	}else{
		            		$status='date-price';
		            		break;
		            	}
		            }
		         }
		         if($stay_flag==0){
		         	if($property->min_stay){
		         		if($property->min_stay<=$day){}else{
		         			$status='min-stay-day';
		         		}
		         	}else{
		         		$status='min-stay-day';
		         	}
		         }
		         $ar=[];
		         $checkinCheckout=LiveCart::iCalDataCheckInCheckOut($property->id);
		        for($i=0;$i<$day;$i++){
		         	$date = strtotime($start_date);
		            $date = strtotime("+".$i." day", $date);
		            $date= date('Y-m-d', $date);
		            $ar[]=$date;
		            if(in_array($date, $checkinCheckout['checkin'])){
		            	$status="already-booked";
		            	break;
		            }
		        } 
	        }
	    }else{
	     	$status='min-stay-day';
	    }
		return ["status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>$total_night,"message"=>$message];
	}
	
	function getPropertyList($start_date,$end_date,$total_sleep){
	    $data=(HostFully::getSearchDataHostFully($start_date,$end_date,$total_sleep));
	    if($data['status']==200){
	    	return $data['data'];
	    }
	    return [];
	}

	function languageChanger($lan){
		Session::put("current_language",$lan);
	}

	function getPropertyStatus(){
		return [
			"property"=>"property",
			"car"=>"car",			
		];
	}
    
    function getShippingHelper($key){
        $ar=[
            "0"=>"New",
            "1"=>"AWB Assigned",
            "2"=>"Label Generated",
            "3"=>"Pickup Scheduled/Generated",
            "4"=>"Pickup Queued",
            "5"=>"Manifest Generated",
            "6"=>"Shipped",
            "7"=>"Delivered",
            "8"=>"Cancelled",
            "9"=>"RTO Initiated",
            "10"=>"RTO Delivered",
            "11"=>"Pending",
            "12"=>"Lost",
            "13"=>"Pickup Error",
            "14"=>"RTO Acknowledged",
            "15"=>"Pickup Rescheduled",
            "16"=>"Cancellation Requested",
            "17"=>"Out For Delivery",
            "18"=>"In Transit",
            "19"=>"Out For Pickup",
            "20"=>"Pickup Exception",
            "21"=>"Undelivered",
            "22"=>"Delayed",
            "23"=>"Partial_Delivered",
            "24"=>"Destroyed",
            "25"=>"Damaged",
            "26"=>"Fulfilled",
            "38"=>"Reached at Destination",
            "39"=>"Misrouted",
            "40"=>"RTO NDR",
            "41"=>"RTO OFD",
            "42"=>"Picked Up",
            "43"=>"Self Fulfilled",
            "44"=>"DISPOSED_OFF",
            "45"=>"CANCELLED_BEFORE_DISPATCHED",
            "46"=>"RTO_IN_TRANSIT"
        ];
        if(isset($ar[$key])){
            return $ar[$key];
        }
        return $key;
    }

    
	function getInstaFeed(){
	    $token = 'IGQVJXS04tRmlqbHFySnEzeGhDWXZA2VjVUTHRmcXQ5LW1WcHBtOXBfeWtWU1Ywc2R1cEI5Tkc1LTlpdzBNbFZAULVUzcmFkbzg5b0tBZAUNJUFp3Y3ppd01PVFc1N3llVkFQa01rLTlZATVVLb0tGelNwcAZDZD';
        $site = 'https://upgradebicycles.com/test/';
        $url = "https://graph.instagram.com/me/media?fields=username,media_type,media_url,permalink,thumbnail_url,timestamp,caption&access_token=$token";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $request = curl_exec($curl);
        curl_close($curl);
        $request = json_decode($request, true);
        if(isset($request['data'])){
            return $request['data'];
        }
        return [];
	}
	
	
	function getSeoUrlGet($title){
		return strtolower(str_replace( array('/', '\\','\'', '"', ',' , ';', '<', '>','&',' ','*','!','@','#','$','%','+',',','.','`','~',':','[',']','{','}','(',')','?'), '-', $title));
	}
	
	function getTypeOfField(){
		return [
			"select"=>"select",
			"text"=>"text",
			"color"=>"color",
			"date"=>"date",
			"time"=>"time",
			"number"=>"number",
			"textarea"=>"textarea",
		];
	}
	
	function getGenderData(){
		return[
			"male"=>"male",
			"female"=>"female",
			'unisex'=>"unisex",
			'kids'=>"kids"
		];
	}

	function getLoginTypeData(){
		return[
			"normal"=>"normal",
			"google"=>"google",
			'facebook'=>"facebook"
		];
	}

	function getDeviceTypeData(){
		return [
			"ios"=>"ios",
			"A"=>"android"
		];
	}
	

	public  function getBooleanData(){
		return ['0'=>"false","1"=>"true"];
	}


	public  function getBooleanDataActual(){
		return ['false'=>"false","true"=>"true"];
	}

	public  function getfirstTrueBooleanData(){
		return ["1"=>"true","0"=>"false"];
	}


	public function getCoupanCodeList(){
		return [
			"exact"=>"Exact",
			"percentage"=>"Percentage"
		];
	}

    public function getAttractionType(){
      return [
	 		"extremal"=>"extremal",
			"internal"=>"internal"
		];
    }
  
	public  function getTempletes(){
		return [
			"common"=>"Common",
			"home"=>"Home",
			"property-management"=>"property-management",
			"car-rentals"=>"car-rentals",
			"about"=>"about",
			"contact"=>"Contact",
			"blogs"=>"blogs",
			"map"=>"map",
			"reviews"=>"reviews",
			"gallery"=>"gallery",
			"property-list"=>"property-list",
			"attractions"=>"attractions",
			"get-quote"=>"get-quote",
			"faq"=>"FAQ"
		];
	}

	function getImage($image){
	    if($image!=""){
	        if(is_file(public_path($image))){
	            return $image;
	        }
	    }
	    return 'uploads/no-image.jpg';
	}
    
    function getWeekNameSelect(){
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];
        return $days;
    }
	
	public function send_notification($registatoin_ids, $title,$body,$device_type,$data='dd',$sound='default') {
     	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		$token=$registatoin_ids;
		$f=0;
        if(strtoupper($device_type)=="ANDROID123"){
           $notification = ['title' =>$title, 'body' =>$body,"sound" => $sound];
            $extraNotificationData = ["message" => $notification,"moredata" =>$data];
            $f=1;
            $fcmNotification = ['to'        => $token, 'notification' => $notification, 'data' => $extraNotificationData];
        }elseif(strtoupper($device_type)=="IOS123"){
            $f=1;
            $notification = array('title' =>$title , 'body' => $body, 'sound' => $sound, 'badge' => '1');
            $fcmNotification = array('to' => $token, 'notification' => $notification,'priority'=>'high',"data"=>$data);
        }
        $headers = [ 'Authorization: key=AAAArFB060k:APA91bH0OSnyRTBP3jQ_JhMQwvDgw8Qcq41wEw-29RcK1pS9lsKDof8Uui5S8zMtU5P3mf_49J0kU1NgcjNQnVIWTJ9ZhhFuSZk2xTsYZHXCJ1OqH1t1mL6TrVdNx-WEArA6SEnmN8gu','Content-Type: application/json' ];
		if($f==1){
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
	        $result = curl_exec($ch);
	        curl_close($ch);
	        return ($result);
		}
  	}
}