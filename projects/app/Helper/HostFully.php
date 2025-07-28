<?php 
namespace App\Helper;
use Auth;
use DB;
use App\Models\BasicSetting;
use App\Models\EmailTemplete;
use Mail;
use Config;
use ModelHelper;
use Helper;
use LiveCart;
use MailHelper;
use App\Models\HostFully\HostFullyAgency;
use App\Models\HostFully\HostFullyPropertyUIDs;
use App\Models\HostFully\HostFullyPropertyPhoto;
use App\Models\HostFully\HostFullyPropertyAmenity;
use App\Models\HostFully\HostFullyPropertyCustomAmenity;
use App\Models\HostFully\HostFullyPropertyExternalCalender;
use App\Models\HostFully\HostFullyPropertyReview;
use App\Models\HostFully\HostFullyProperty;
use App\Models\HostFully\HostFullyPropertyDescription;
use App\Models\HostFully\HostFullyPropertyPricePeriod;

use App\Models\HostFully\HostFullyPropertyRule;
/**
 * Class Helper
 * @package App\Helper
 */
class HostFully{

    function getAPIKey(){
        return 'TaL5r3WOWcuG0gO3';
    }

    function getAgencies(){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/agencies",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }
            else{
                 $fillable=[
                     "uid","name","agencyEmailAddress","phoneNumber","website","address1","city","zipCode","state","currency","currencyCode","countryCode","defaultCheckInTime","defaultCheckOutTime","rentalCondition",
                ];
                foreach($response['agencies'] as $result){
                    $new_array=[];
                    foreach($result as $key=>$r){
                        if(in_array($key, $fillable)){
                            $new_array[$key]=$r;
                        }
                    }
                    $review=HostFullyAgency::where("uid",$result['uid'])->first();
                    if($review){
                        HostFullyAgency::where("uid",$result['uid'])->update($new_array);
                    }else{
                        HostFullyAgency::create($new_array);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getPropertiesUIDsList(){
        $this->getAgencies();
        foreach(HostFullyAgency::all() as $agency){
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.hostfully.com/api/v3/properties?agencyUid=".$agency->uid."&limit=2000&offset=0",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json" ]
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return ["status"=>400,"message"=>$err];
            } else {
                $response=(json_decode($response,true));
                if(isset($response['apiErrorMessage'])){
                    return ["status"=>400,"message"=>$response['apiErrorMessage']];
                }
                else{
                    $fillable=["uid","agency_uid"];
                    foreach($response['properties'] as $result){
                        $new_array=[];
                        $newResultData=[];
                        $newResultData['property']=$result;
                        $result=(array)$result;
                        $new_array['propertiesUid']=$result['uid'];
                        $review=HostFullyPropertyUIDs::where($new_array)->first();
                        if($review){    
                            $new_array['agency_uid']=$agency->uid;
                            $review->update($new_array);
                        }else{
                            $new_array['agency_uid']=$agency->uid;
                            HostFullyPropertyUIDs::create($new_array);
                        }
                        $this->getNewPropertyDetail($result['uid'],$newResultData);
                    }
                    return ["status"=>"200","message"=> "Success"];
                }
            }
        }
    }

    function getNewPropertyDetail($proeprtyUid,$response){
        
       
        $data=$response['property'];
        if(isset($response['property']['address'])){
            if(isset($response['property']['address']['address2'])){
                $data['address2']=$response['property']['address']['address2'];
            }
            if(isset($response['property']['address']['zipCode'])){
                $data['postalCode']=$response['property']['address']['zipCode'];
            }
            if(isset($response['property']['address']['city'])){
                $data['city']=$response['property']['address']['city'];
            }
            if(isset($response['property']['address']['state'])){
                $data['state']=$response['property']['address']['state'];
            }
            if(isset($response['property']['address']['longitude'])){
                $data['longitude']=$response['property']['address']['longitude'];
            }
            if(isset($response['property']['address']['latitude'])){
                $data['latitude']=$response['property']['address']['latitude'];
            }
            if(isset($response['property']['address']['countryCode'])){
                $data['countryCode']=$response['property']['address']['countryCode'];
            }
            if(isset($response['property']['address']['address'])){
                $data['address1']=$response['property']['address']['address'];
            }
            unset($data['address']); 
        }
        if(isset($response['property']['area'])){
            if(isset($response['property']['area']['unitType'])){
                $data['area_unitType']=$response['property']['area']['unitType'];
            }
            if(isset($response['property']['area']['size'])){
                $data['area_size']=$response['property']['area']['size'];
            }
            unset($data['area']);
        }
        if(isset($response['property']['availability'])){
            if(isset($response['property']['availability']['baseGuests'])){
                $data['baseGuests']=$response['property']['availability']['baseGuests'];
            }
            if(isset($response['property']['availability']['maxGuests'])){
                $data['maxGuests']=$response['property']['availability']['maxGuests'];
            }
            if(isset($response['property']['availability']['minimumStay'])){
                $data['minimumStay']=$response['property']['availability']['minimumStay'];
            }
            unset($data['availability']);
        }
        if(isset($response['property']['pricing'])){
            if(isset($response['property']['pricing']['currency'])){
                $data['currency']=$response['property']['pricing']['currency'];
            }
            if(isset($response['property']['pricing']['dailyRate'])){
                $data['dailyRate']=$response['property']['pricing']['dailyRate'];
            }
            if(isset($response['property']['pricing']['baseGuests'])){
                $data['baseGuests']=$response['property']['pricing']['baseGuests'];
            }
            unset($data['pricing']);
        }
        if(isset($response['property']['airbnbData'])){
            unset($data['airbnbData']);
        }
        if(isset($response['property']['hvmiData'])){
            unset($data['hvmiData']);
        }
        if(isset($response['property']['vrboData'])){
            unset($data['vrboData']);
        }
        if(isset($response['property']['bookingDotComData'])){
            unset($data['bookingDotComData']);
        }
        $data['all_data_json']=json_encode($response);
        $property=HostFullyProperty::where(["uid"=>$data['uid']])->first();
        if($property){
            HostFullyProperty::where(["uid"=>$data['uid']])->update($data);
        }else{
            $seo_url=Helper::getSeoUrlGet(strtolower(str_replace(" ","-",$data['name'])).'-'.$data['uid']);
            $data['seo_url']=$seo_url;
            $data['meta_title']=substr($data['name'],0,60);
            $data['meta_keywords']=$data['name'];
            $data['meta_description']=substr($data['name'],0,160);
            (HostFullyProperty::create($data));
        }
        $this->getPropertyPriceRulesDetail($proeprtyUid);
        $this->getPropertyDescriptionList($proeprtyUid);
        $this->getPropertyPhoto($proeprtyUid);
        $this->getPropertyAmenity($proeprtyUid);
        $this->getPropertyCustomAmenity($proeprtyUid);
        $this->getReview($proeprtyUid);
        $this->getPropertyPricePeriodList($proeprtyUid);
    }

    function getSearchDataHostFully($start_date,$end_date,$total_guests=1){
        $properties_uid=[];
        foreach(HostFullyAgency::all() as $agency){
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.hostfully.com/v2/properties?agencyUid=".$agency->uid."&checkInDate=".$start_date."&checkOutDate=".$end_date."&limit=2000&offset=0&minimumGuests=".$total_guests,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => [ "X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return ["status"=>400,"message"=>$err];
            } else {
                $response=(json_decode($response,true));
                if(isset($response['apiErrorMessage'])){
                    return ["status"=>400,"message"=>$response['apiErrorMessage']];
                }else{
                    $fillable=["propertiesUid","agency_uid"];
                    foreach($response['propertiesUids'] as $result){
                        $new_array=[];
                        $result=(array)$result;
                        foreach($result as $key=>$r){
                            $new_array['propertiesUid']=$r;
                            $properties_uid[]=$r;
                        }
                    }
                }
            }
        }
        return ["status"=>200,"message"=>"success","data"=>$properties_uid];
    }

    function getQuote($agencyUid,$property_uid,$start_date,$end_date,$total_guests){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/api/v3/quotes",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '{"agencyUid":"'.$agencyUid.'","propertyUid":"'.$property_uid.'","checkInDate":"'.$start_date.'","checkOutDate":"'.$end_date.'","guests":'.$total_guests.'}',
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json","content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }
            else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }
    
    
    function getQuoteNew($agencyUid,$property_uid,$start_date,$end_date,$total_guests,$lead_id){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/api/v3/quotes",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '{"agencyUid":"'.$agencyUid.'","leadUid":"'.$lead_id.'","propertyUid":"'.$property_uid.'","checkInDate":"'.$start_date.'","checkOutDate":"'.$end_date.'","guests":'.$total_guests.'}',
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json","content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }
            else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }
    
    function createLeadGetQuote($agencyUid,$uid,$email,$mobile,$firstname,$lastname,$start_date,$end_date,$adults,$child,$type,$pet=0){
       // dd($agencyUid,$uid,$email,$mobile,$firstname,$lastname,$start_date,$end_date,$adults,$child,$type,$pet);
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/api/v3/leads",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '{"propertyUid": "'.$uid.'","agencyUid": "'.$agencyUid.'","checkInLocalDateTime": "'.$start_date.'T12:57:46","checkOutLocalDateTime": "'.$end_date.'T12:57:46","checkInLocalDate": "'.$start_date.'","checkOutLocalDate": "'.$end_date.'","status": "'.$type.'","guestInformation": {"firstName": "'.$firstname.'","lastName": "'.$lastname.'","adultCount": '.$adults.',"childrenCount": '.$child.',"infantCount" :0,"petCount": '.$pet.',"email": "'.$email.'","phoneNumber": "'.$mobile.'","preferredCurrency": "USD"}}',
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),'accept' => '*/*',"content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function sendTranctionData($amount,$orderid,$notes,$trans_id){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/api/v3/transactions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '{"manual":true,"type":"SALE","status":"SUCCESS","amount":'.$amount.',"fullPayment":true,"transactionId":"'.$trans_id.'","notes":"'.$notes.'","orderUid":"'.$orderid.'"}',
          CURLOPT_HTTPHEADER => [ "X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json","content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }
            else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function deleteBooking($uid){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/v2/leads/".$uid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_HTTPHEADER => [
            "X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),
            "accept: application/json"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function updateLeadDataNew($uid,$pro_uid,$start_date,$end_date,$email,$name,$adults,$child,$mobile){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.hostfully.com/api/v3/leads/'.$uid.'/mark-as-booked',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(), "accept: */*","content-type: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }
    
    
    
    
    function updateLeadDataNew1($uid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.hostfully.com/api/v3/leads/'.$uid.'/mark-as-booked',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(), "accept: */*","content-type: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }


    function cancelLeadDataNew($uid,$pro_uid,$start_date,$end_date,$email,$name,$adults,$child,$mobile){
          $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.hostfully.com/api/v3/leads/'.$uid.'/cancel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(), "accept: */*","content-type: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function createLeadDataNew($agencyUid,$uid,$start_date,$end_date,$email,$mobile,$firstname,$lastname,$adults,$child,$type,$pet=0){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/api/v3/leads",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '{"propertyUid": "'.$uid.'","agencyUid": "'.$agencyUid.'","checkInLocalDateTime": "'.$start_date.'T12:57:46","checkOutLocalDateTime": "'.$end_date.'T12:57:46","checkInLocalDate": "'.$start_date.'","checkOutLocalDate": "'.$end_date.'","status": "'.$type.'","guestInformation": {"firstName": "'.$firstname.'","lastName": "'.$lastname.'","adultCount": '.$adults.',"childrenCount": '.$child.',"infantCount" :0,"petCount": '.$pet.',"email": "'.$email.'","phoneNumber": "'.$mobile.'","preferredCurrency": "USD"}}',
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),'accept' => '*/*',"content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function createLeadData($uid,$start_date,$end_date,$email,$name,$adults,$child){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/v2/leads",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"status\":\"NEW\",\"adultCount\":".$adults.",\"childrenCount\":".$child.",\"petCount\":0,\"infantCount\":0,\"riskScore\":0,\"leadType\":\"BOOKING\",\"propertyUid\":\"".$uid."\",\"checkInDate\":\"".$start_date."\",\"checkOutDate\":\"".$end_date."\",\"email\":\"".$email."\",\"firstName\":\"".$name."\"}",
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json","content-type: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }

    function getOrderDetail($uid,$leadid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/orders?leadUid=".$leadid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [ "X-HOSTFULLY-APIKEY: ".$this->getAPIKey(), "accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success","data"=>$response];
            }
        }
    }
    
    
    

    function getPropertyPriceRulesDetail($uid){
     //   dd($uid);
     HostFullyPropertyRule::where("propertyUid",$uid)->delete();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/property-rules?propertyUid=".$uid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [ "X-HOSTFULLY-APIKEY: ".$this->getAPIKey(), "accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                if(isset($response['propertyRules'])){
                    foreach($response['propertyRules'] as $p){
                        HostFullyPropertyRule::create($p);
                    }
                }
                
            }
        }
    }

    function getPropertiesList(){
        $this->getPropertiesUIDsList();
    }

    function getPropertyDetail($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/properties/".$proeprtyUid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }
            else{
                $data=$response['property'];
                if(isset($response['property']['address'])){
                    if(isset($response['property']['address']['address2'])){
                        $data['address2']=$response['property']['address']['address2'];
                    }
                    if(isset($response['property']['address']['zipCode'])){
                        $data['postalCode']=$response['property']['address']['zipCode'];
                    }
                    if(isset($response['property']['address']['city'])){
                        $data['city']=$response['property']['address']['city'];
                    }
                    if(isset($response['property']['address']['state'])){
                        $data['state']=$response['property']['address']['state'];
                    }
                    if(isset($response['property']['address']['longitude'])){
                        $data['longitude']=$response['property']['address']['longitude'];
                    }
                    if(isset($response['property']['address']['latitude'])){
                        $data['latitude']=$response['property']['address']['latitude'];
                    }
                    if(isset($response['property']['address']['countryCode'])){
                        $data['countryCode']=$response['property']['address']['countryCode'];
                    }
                    if(isset($response['property']['address']['address'])){
                        $data['address1']=$response['property']['address']['address'];
                    }
                    unset($data['address']);
                }
                if(isset($response['property']['area'])){
                    if(isset($response['property']['area']['unitType'])){
                        $data['area_unitType']=$response['property']['area']['unitType'];
                    }
                    if(isset($response['property']['area']['size'])){
                        $data['area_size']=$response['property']['area']['size'];
                    }
                    unset($data['area']);
                }
                if(isset($response['property']['availability'])){
                    if(isset($response['property']['availability']['baseGuests'])){
                        $data['baseGuests']=$response['property']['availability']['baseGuests'];
                    }
                    if(isset($response['property']['availability']['maxGuests'])){
                        $data['maxGuests']=$response['property']['availability']['maxGuests'];
                    }
                    if(isset($response['property']['availability']['minimumStay'])){
                        $data['minimumStay']=$response['property']['availability']['minimumStay'];
                    }
                    unset($data['availability']);
                }
                if(isset($response['property']['pricing'])){
                    if(isset($response['property']['pricing']['currency'])){
                        $data['currency']=$response['property']['pricing']['currency'];
                    }
                    if(isset($response['property']['pricing']['dailyRate'])){
                        $data['dailyRate']=$response['property']['pricing']['dailyRate'];
                    }
                    if(isset($response['property']['pricing']['baseGuests'])){
                        $data['baseGuests']=$response['property']['pricing']['baseGuests'];
                    }
                    unset($data['pricing']);
                }
                if(isset($response['property']['airbnbData'])){
                    unset($data['airbnbData']);
                }
                if(isset($response['property']['hvmiData'])){
                    unset($data['hvmiData']);
                }
                if(isset($response['property']['vrboData'])){
                    unset($data['vrboData']);
                }
                if(isset($response['property']['bookingDotComData'])){
                    unset($data['bookingDotComData']);
                }
                $data['all_data_json']=json_encode($response);
                $property=HostFullyProperty::where(["uid"=>$data['uid']])->first();
                if($property){
                    HostFullyProperty::where(["uid"=>$data['uid']])->update($data);
                }else{
                    $seo_url=Helper::getSeoUrlGet(strtolower(str_replace(" ","-",$data['name'])).'-'.$data['uid']);
                    $data['seo_url']=$seo_url;
                    $data['meta_title']=substr($data['name'],0,60);
                    $data['meta_keywords']=$data['name'];
                    $data['meta_description']=substr($data['name'],0,160);
                    HostFullyProperty::create($data);
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesAmenities(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyAmenity($c->propertiesUid));
        }
    }

    function getPropertyAmenity($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/amenities?propertyUid=".$proeprtyUid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            } else{
                HostFullyPropertyAmenity::where(["property_uid"=>$proeprtyUid])->delete();
               foreach($response['amenities'] as $result){
                    $result['property_uid']=$proeprtyUid;
                    $r=HostFullyPropertyAmenity::where(["uid"=>$result['uid'],"property_uid"=>$proeprtyUid])->first();
                    if($r){
                        HostFullyPropertyAmenity::where(["uid"=>$result['uid'],"property_uid"=>$proeprtyUid])->update($result);
                    }else{
                        HostFullyPropertyAmenity::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesCustomAmenities(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyCustomAmenity($c->propertiesUid));
        }
    }

    function getPropertyCustomAmenity($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/custom-amenities?objectType=PROPERTY&objectUid=".$proeprtyUid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                HostFullyPropertyCustomAmenity::where(["property_uid"=>$proeprtyUid])->delete();
                foreach($response['customAmenities'] as $result){
                    $result['property_uid']=$proeprtyUid;
                    $ar=['property_uid'=>$proeprtyUid,"uid"=>$result['uid']];
                    $r=HostFullyPropertyCustomAmenity::where($ar)->first();
                    if($r){
                        HostFullyPropertyCustomAmenity::where($ar)->update($result);
                    }else{
                        HostFullyPropertyCustomAmenity::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesExternalCalendars(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyExternalCalendars($c->propertiesUid));
        }
    }

    function getPropertyExternalCalendars($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.hostfully.com/api/v3/property-calendar?propertiesUids='.$proeprtyUid.'&from=2024-04-25&to=2024-07-25',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                foreach($response as $result){
                    $result['property_uid']=$proeprtyUid;
                    $ar=['property_uid'=>$proeprtyUid,"uid"=>$result['uid']];
                    $r=HostFullyPropertyExternalCalender::where($ar)->first();
                    if($r){
                        HostFullyPropertyExternalCalender::where($ar)->update($result);
                    }else{
                        HostFullyPropertyExternalCalender::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesPhoto(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyPhoto($c->propertiesUid));
        }
    }

    function getPropertyPhoto($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com//api/v3/photos?propertyUid=".$proeprtyUid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                HostFullyPropertyPhoto::where(["property_uid"=>$proeprtyUid])->delete();
                foreach($response['photos'] as $result){
                    $result['url']=$result['originalImageUrl'];
                    unset($result['propertyUid']);
                    $result['property_uid']=$proeprtyUid;
                    $ar=['property_uid'=>$proeprtyUid,"uid"=>$result['uid']];
                    $r=HostFullyPropertyPhoto::where($ar)->first();
                    if($r){
                        HostFullyPropertyPhoto::where($ar)->update($result);
                    }else{
                        HostFullyPropertyPhoto::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesReview(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getReview($c->propertiesUid));
        }
    }

    function getReview($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.hostfully.com/api/v3/reviews?propertyUid=".$proeprtyUid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                HostFullyPropertyReview::where(["property_uid"=>$proeprtyUid])->delete();
                foreach($response['reviews'] as $result){
                    $result['property_uid']=$proeprtyUid;
                    $ar=['property_uid'=>$proeprtyUid,"uid"=>$result['uid']];
                    $r=HostFullyPropertyReview::where($ar)->first();
                    if($r){
                        HostFullyPropertyReview::where($ar)->update($result);
                    }else{
                        HostFullyPropertyReview::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesCalender(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyCalenderList($c->propertiesUid));
        }
    }

    function getPropertyCalenderList($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.hostfully.com/v2/propertycalendar/".$proeprtyUid."?from=2023-06-27&to=2023-08-27&notes=false",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                return ["status"=>"200","message"=> "Success"];
            }
        }
    }

    function getAllPropertiesDescription(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyDescriptionList($c->propertiesUid));
        }
    }

    function getPropertyDescriptionList($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
           CURLOPT_URL => "https://api.hostfully.com/api/v3/property-descriptions?propertyUid=".$proeprtyUid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            } else{
                $ar=[];
                foreach($response['propertyDescriptions'] as $result){
                    $result['property_uid']=$proeprtyUid;
                    $r=HostFullyPropertyDescription::where(["property_uid"=>$proeprtyUid])->first();
                    if($r){
                        HostFullyPropertyDescription::where(["property_uid"=>$proeprtyUid])->update($result);
                    }else{
                        HostFullyPropertyDescription::create($result);
                    }
                }
                return ["status"=>"200","message"=> "Success","data"=>$ar];
            }
        }
    }

    function getAllPropertiesPricePeriod(){
        foreach(HostFullyPropertyUIDs::all() as $c){
            ($this->getPropertyPricePeriodList($c->propertiesUid));
        }
    }

    function getPropertyPricePeriodList($proeprtyUid){
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'https://api.hostfully.com/api/v3/property-calendar?propertiesUids='.$proeprtyUid.'&from='.date('Y-m-d').'&to='.date('Y-m-d',strtotime('+3 Years',strtotime(date('Y-m-d')))),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => ["X-HOSTFULLY-APIKEY: ".$this->getAPIKey(),"accept: application/json"]
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return ["status"=>400,"message"=>$err];
        } else {
            $response=(json_decode($response,true));
            if(isset($response['apiErrorMessage'])){
                return ["status"=>400,"message"=>$response['apiErrorMessage']];
            }else{
                if(isset($response['calendars'])){
                    foreach($response['calendars'] as $singleCanender){
                        if(isset($singleCanender['entries'])){
                            foreach($singleCanender['entries'] as $single){
                                $ar=[
                                    "propertyUid" =>$proeprtyUid,
                                    "from_date"=>$single['date'] ,
                                    "amount" =>$single['pricing']['value'] ,
                                    "minimumStay" =>$single['availability']['minimumStayLength'] ,
                                    "isCheckinAllowed"=>$single['availability']['availableForCheckIn']  ,
                                    "isCheckoutAllowed" =>$single['availability']['availableForCheckOut'] ,
                                    'unavailable'=>$single['availability']['unavailable'] 
                                ];
                                $arse=HostFullyPropertyPricePeriod::where(["propertyUid" =>$proeprtyUid,"from_date"=>$single['date']])->first();
                                if($arse){
                                    HostFullyPropertyPricePeriod::where(["propertyUid" =>$proeprtyUid,"from_date"=>$single['date']])->update($ar);
                                }else{
                                    HostFullyPropertyPricePeriod::create($ar);
                                }

                            }
                        }
                    }
                }
            }
        }
    }
}