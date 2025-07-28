<?php

namespace App\Http\Controllers;
use App\Models\IcalEvent;
use LiveCart;
use MailHelper;
use ModelHelper;
use App\Models\Property;
use App\Models\PropertyRate;
use App\Models\BookingRequest;

class ICalController extends Controller
{
  
   /**
    * Gets the events data from the database
    * and populates the iCal object.
    *
    * @return void
    */

   
   function refresshCalendar(){
    LiveCart::allIcalImportListRefresh();
    return redirect()->back()->with("success","successfully refreshed");
   }

  
   function sendWelcomePackage(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('welcome_package_send_day').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","welcome_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.welcome-package-admin",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('welcome_package_receiving_mail');
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.welcome-package-customer",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["welcome_email"=>"true"]);
            }
        }
        
        return redirect()->back();
   }  
   
   function sendReminderPackage(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>2,"how_many_payment_done"=>1,"reminder_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>3,"how_many_payment_done"=>1,"third_reminder_email"=>"false","reminder_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
             
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>3,"how_many_payment_done"=>2,"third_reminder_email"=>"false"])->where("checkin",$date)->get();

        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["third_reminder_email"=>"true"]);
            }
        }
        
        return redirect()->back();
   }

   function sendReviewEmail(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('review_send_day').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","review_email"=>"false"])->where("checkout",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
              
                $html= view("mail.review-admin",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('review_receiving_mail');
                $admin_subject="Review in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.review-customer",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Review in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["review_email"=>"true"]);
            }
        }
        return redirect()->back();
   }
}