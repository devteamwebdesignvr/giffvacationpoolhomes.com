<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NewsLetter; 
use App\Models\Cms; 
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategory;
use App\Models\ContactusRequest;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Property;
use App\Models\Location;
use App\Models\Attraction;
use App\Models\BookingRequest;
use App\Models\HostFully\HostFullyProperty;
use Image;
use Mail;
use Auth;
use App\Helper\Upload;
use ModelHelper;
use Helper;
use DB;
use MailHelper;
use LiveCart;
use Session;
use Response;
use Validator;
use HostFully;

class PageController extends Controller{

    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }

    function runPropertiesData(){
        HostFully::getPropertiesList();
        return redirect()->back();
    }

    function propertyDetail($seo_url){
        $data=HostFullyProperty::where("seo_url",$seo_url)->where(["isActive"=>"1","status"=>"true"])->first();
        if($data){
            return view("front.property.singleHostFully",compact("data"));
        }
        return abort(404);
    }

    function carDetail($seo_url){
        $data=Property::where("seo_url",$seo_url)->where(["property_status"=>"car"])->first();
        if($data){
            return view("front.property.car-single",compact("data"));
        }
        return abort(404);
    }

    function attractionSingle($seo_url){
        $data=Attraction::where("seo_url",$seo_url)->first();
        if($data){
            return view("front.attractions.single",compact("data"));
        }
        return abort(404);
    }

    function attractionLocation($seo_url){
        $data=Location::where("seo_url",$seo_url)->first();
        if($data){
            return view("front.attractions.location",compact("data"));
        }
        return abort(404);
    }

    function propertyLocation($seo_url){
        $data=Location::where("seo_url",$seo_url)->first();
        if($data){
            return view("front.property.location",compact("data"));
        }
        return abort(404);
    }

    function reviewSubmit(Request $request){
         $validator = Validator::make($request->all(), ['email' => 'required|email','name'=>"required","message"=>"required"]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        Testimonial::create($request->all());
        return redirect()->back()->with("success","Thank you for submitting your review");
    }
    
    function contactPost(Request $request){
        $validator = Validator::make($request->all(), ['email' => 'required|email','name'=>"required","message"=>"required",'captcha' => 'required|captcha']);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger1",$validator->errors()->first())->withErrors($validator->errors());
        }
        if(ModelHelper::getDataFromSetting('g_captcha_enabled')):
            if(ModelHelper::getDataFromSetting('g_captcha_enabled')=="yes"):
                if(ModelHelper::getDataFromSetting('google_captcha_site_key')!="" && ModelHelper::getDataFromSetting('google_captcha_secret_key')!=""):
                    if($request->get('g-recaptcha-response')):
                        $secretKey = ModelHelper::getDataFromSetting('google_captcha_secret_key');
                        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$request->get('g-recaptcha-response'));
                        $responseData = json_decode($verifyResponse);
                        if($responseData->success){}else{
                            return redirect()->back()->withInput()->with("danger1","Robot verification failed, please try again.");
                        }
                    else:
                        return redirect()->back()->withInput()->with("danger1","Please check on the reCAPTCHA box.");
                    endif;
                endif;
            endif;
        endif;
        ContactusRequest::create($request->all());
        $mailData=["type"=>"thank_you_for_feedback_user",'username'=>$request->name,"to"=>$request->email];
        MailHelper::emailSender($mailData);
        $mailData=["type"=>"feedback_admin",'username'=>$request->name,'useremail'=>$request->email,'usermobile'=>$request->mobile,'usermessage'=>$request->message,"to"=>ModelHelper::getDataFromSetting('contact_us_receiving_mail')];
        MailHelper::emailSender($mailData);
        return redirect()->back()->with("success1","Thank you for submitting your query, we will get in touch shortly");
    }

    function newsletterPost(Request $request){
        $validator = Validator::make($request->all(), ['email' => 'required|email|unique:newsletters,email']);   
        if($validator->fails()){
            return  response()->json(["status"=>400,"message"=>$validator->errors()->first()]);
        }
        $data=NewsLetter::where("email",$request->email)->first();
        if($data){
            return  response()->json(["status"=>400,"message"=>'Already subscribe']);
        }else{
            NewsLetter::create(["email"=>$request->email]);
            $mailData=[ "type"=>"newsletter",'useremail'=>$request->email,"to"=>ModelHelper::getDataFromSetting('contact_us_receiving_mail')];
            MailHelper::emailSender($mailData);
            return  response()->json(["status"=>200,"message"=>'Thank you for subscribe']);
        }
    }

    function categoryData($seo){
        $data=BlogCategory::where("seo_url",$seo)->first();
        if($data){
            $blogs=Blog::where("blog_category_id",$data->id)->orderBy("id","desc")->paginate(12);
            return view("front.group.category",compact("data","blogs"));
        }
        return abort(404);
    }

    function blogSingle($seo_url){
        $data=Blog::where("seo_url",$seo_url)->first();
        if($data){
            $category=BlogCategory::find($data->blog_category_id);
            return view("front.group.single",compact("data","category"));
        }
        return abort(404);
    }

    public function index(){
        $data=Cms::where("seo_url",'home')->first();
        if($data){
            if($data->templete=="home"){
                $templete="front.static.".$data->templete;
                return view($templete,compact("data"));
            }
        }
        return abort(404);
    }
    
    function adminCheckAjaxGetQuoteData(Request $request){
    }
    
    function adminCheckAjaxGetQuoteDataEdit(Request $request){
    }

    function checkAjaxGetQuoteData(Request $request){
        if($request->property_id){
            $property=Property::find($request->property_id);
            if($request->start_date){
                if($request->end_date){
                    $main_data=Helper::getGrossAmountData($property,$request->start_date,$request->end_date);
                    if($main_data['status']=="true"){
                        $main_data['start_date']=$request->get("start_date");
                        $main_data['end_date']=$request->get("end_date");
                        $main_data['adults']=$request->get("adults");
                        $main_data['childs']=$request->get("childs");
                        $main_data['pet_fee_data_guarav']=$request->get("pet_fee_data_guarav");
                        $data_view=view("front.property.ajax-gaurav-data-get-quote",compact("property","main_data"))->render();
                        $modal_day_view=view("front.property.ajax-gaurav-modal-day-get-quote",compact("property","main_data"))->render();
                        $modal_service_view=view("front.property.ajax-gaurav-modal-service-get-quote",compact("property","main_data"))->render();
                        return response()->json(["message"=>"success","status"=>200,"modal_day_view"=>$modal_day_view,"modal_service_view"=>$modal_service_view,"data_view"=>$data_view]);
                    }else if($main_data['status']=="already-booked"){
                        return response()->json(["message"=>"Already booked some date","status"=>400]);
                    }else if($main_data['status']=="min-stay-day"){
                        return response()->json(["message"=>"Minimum stay is not statisfy","status"=>400]);
                    }else if($main_data['status']=="checkin-checkout-day"){
                        return response()->json(["message"=>$main_data['message'],"status"=>400]);
                    }else if($main_data['status']=="date-price"){
                        return response()->json(["message"=>"Price is not defined","status"=>400]);
                    }else{
                        return response()->json(["message"=>"Invalid Calling","status"=>400]);
                    }
                }else{
                    return response()->json(["message"=>"Invalid Checkout","status"=>400]);
                }
            }else{
                return response()->json(["message"=>"Invalid Checkin","status"=>400]);
            }
        }else{
            return response()->json(["message"=>"Property Not select","status"=>400]);
        }
    }

    public function dynamicDataCategory(Request $request,$seo_url){
        if($seo_url=="home"){
          return redirect("/");
        }
        $data=Cms::where("seo_url",$seo_url)->first();
        if($data){
            $templete="front.static.".$data->templete;
            if($data->templete=="blogs"){
                $blogs=Blog::orderBy("id","desc")->paginate(12);
               return view($templete,compact("data","blogs"));
            }
            else if($data->templete=="get-quote"){
                if($request->property_id){
                    $property=HostFullyProperty::find($request->property_id);
                    if($request->start_date){
                        if($request->end_date){
                                $total_guests=$request->adults+$request->child;
                                $days=Helper::calculateDays($request->get("start_date"),$request->get("end_date"));
                                
                                if($days>0){
                                    if($property->minimumStay>=$days){
                                        return redirect('properties/detail/'.$property->seo_url)->with("danger","Minimum Stay Not meet, Minimum Stay is ".$property->minimumStay);
                                    }
                                }else{
                                    return redirect('properties/detail/'.$property->seo_url)->with("danger","Checkin and checkout Date are invalid");
                                }
                                if($total_guests>0){
                                    if($property->maxGuests>=$total_guests){}else{
                                        return redirect('properties/detail/'.$property->seo_url)->with("danger","Maximum Guest exceed");
                                    }
                                }else{
                                    return redirect('properties/detail/'.$property->seo_url)->with("danger","Invalid Person");
                                }
                                                                
                                /*
                                $pet=0;
                                if($request->pet){
                                    $pet=$request->pet;
                                }
                                $email="steven@webdesignvr.com";
                                $mobile='';
                                $firstname='test';
                                $lastname='';
                                            $main_data=HostFully::getQuoteNew($property->agencyUid,$property->uid,$request->start_date,$request->end_date,$total_guests,'4ff6f32c-3837-47d2-b2c8-f29ff4135e10');
                                            dd($main_data);
                                dd(HostFully::createLeadGetQuote($property->agencyUid,$property->uid,$email,$mobile,$firstname,$lastname,$request->start_date,$request->end_date,$request->adults,$request->child,'NEW',$pet));
                                
                                */
                                $main_data=HostFully::getQuote($property->agencyUid,$property->uid,$request->start_date,$request->end_date,$total_guests);
                              // dd($main_data);
                                if($main_data['status']==200){
                                    $main_data=$main_data['data'];
                                    return view($templete,compact("data","main_data","property"));
                                }else{
                                    return redirect('properties/detail/'.$property->seo_url)->with("danger",$main_data['message']);
                                }
                        }else{
                            return redirect('properties/detail/'.$property->seo_url)->with("danger","Invalid Checkout");
                        }
                    }else{
                        return redirect('properties/detail/'.$property->seo_url)->with("danger","Invalid Checkin");
                    }
                    
               }else{
                    return redirect()->back()->with("danger","Invalid Property");
                }
            }else{
               return view($templete,compact("data"));
           }
        }
        return abort(404);
    }

    function saveBookingData(Request $request){
        if($request->property_id){
            $property=HostFullyProperty::find($request->property_id);
            if($property){
                if($request->checkin){
                    if($request->checkout){
                        $data=$request->except(["_token","operation"]);
                        $data['name']=$request->firstName." ".$request->lastName;
                        $host_data=HostFully::createLeadDataNew($property->agencyUid,$property->uid,$request->checkin,$request->checkout,$request->email,$request->mobile,$request->firstName,$request->lastName,$request->adults,$request->child,"NEW",$request->pet_no);
                        if($host_data['status']==200){
                            $ar_gaurav_data=BookingRequest::where("request_id",$request->request_id)->first();
                            if($ar_gaurav_data){
                                BookingRequest::where("request_id",$request->request_id)->update($data);
                                $booking=BookingRequest::where("request_id",$request->request_id)->first();
                            }else{
                                $booking=BookingRequest::create($data);
                            }
                            $host_data1=$host_data['data']['lead'];
                            $host_data1['metadata']=json_encode($host_data1['metadata']);
                            $host_data1['guestInformation']=json_encode($host_data1['guestInformation']);
                            BookingRequest::where("request_id",$request->request_id)->update($host_data1);
                            $booking=BookingRequest::where("request_id",$request->request_id)->first();
                            $data=$booking;
                            $html=view("mail.booking-user-email",compact("data","property"))->render();
                            $to=$request->email;
                            $customer_subject="Booking Request for ".$property->name;
                            MailHelper::emailSenderByController($html,$to,$customer_subject);
                            $html=view("mail.booking-admin-email",compact("data","property"))->render();
                            $to=ModelHelper::getDataFromSetting('booking_receiving_mail');
                            $admin_subject="Booking Request for ".$property->name;
                            MailHelper::emailSenderByController($html,$to,$admin_subject);
                            if($request->operation=="direct-booking"){
                                $new_data=['booking_status'=>"rental-aggrement"];
                                BookingRequest::find($booking->id)->update($new_data);
                                return redirect('booking/rental-aggrement/'.$booking->id);
                            }else{
                                return redirect('booking/preview/'.$booking->id);
                            }
                        }else{
                           return redirect()->back()->with("danger",$host_data['message']);
                        }
                    }else{
                        return redirect()->back()->with("danger","Invalid Checkout");
                    }     
                }else{
                    return redirect()->back()->with("danger","Invalid Checkin");
                }
            }else{
                return redirect()->back()->with("danger","Invalid Property");
            }
        }else{
            return redirect()->back()->with("danger","Invalid Property");
        }
    }

    function previewBooking(Request $request , $id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=HostFullyProperty::find($booking->property_id);
            if($property){
                $data = new \stdClass();
                $data->name="Booking Request";
                $data->meta_title="Booking Request";
                $data->meta_keywords="Booking Request";
                $data->meta_description="Booking Request";
                $booking=$booking->toArray();
                return view("front.booking.preview",compact("booking","data","property"));
            }
        }
        return abort(404);
    }

    function rentalAggrementBooking(Request $request , $id){
        $booking=BookingRequest::find($id);
        if($booking){
             if($booking->rental_aggrement_status!="true"){
                $property=HostFullyProperty::find($booking->property_id);
                if($property){
                    $data = new \stdClass();
                    $data->name="Rental Agreement  ";
                    $data->meta_title="Rental Agreement  ";
                    $data->meta_keywords="Rental Agreement  ";
                    $data->meta_description="Rental Agreement  ";
                    $booking=$booking->toArray();
                    return view("front.booking.rentalAggrementBooking",compact("booking","data","property"));
                }
             }else{
                return redirect()->to('booking/payment/paypal/'.$booking->id)->with("danger","Rental Agreement already submitted");
            }
        }
        return abort(404);
    }

    function rentalAggrementDataSave(Request $request){
        if($request->booking_id){
            $booking=BookingRequest::find($request->booking_id);
            if($booking){
                if($booking->rental_aggrement_status!="true"){
                    $property=HostFullyProperty::find($booking->property_id);
                    if($property){
                        $png_url = "signature-".time().".png";
                        $path = public_path().'/uploads/signature/' . $png_url;
                        Image::make(file_get_contents($request->signature))->save($path); 
                        $data=$request->all();
                        $booking->rental_aggrement_status="true";
                        if ($request->hasFile("image")) {
                            $booking->rental_aggrement_images = Upload::fileUpload($request->file("image"),"cms");
                        }
                        $booking->rental_agreement_link =$property->rental_aggrement_attachment;
                        $booking->rental_aggrement_signature='uploads/signature/' . $png_url;
                        $booking->booking_status="rental-aggrement-success";
                        $booking->save();
                        $data=BookingRequest::find($request->booking_id)->toArray();
                        $html= view("mail.rental-aggrement-admin",compact("data","property"))->render();
                        $to=ModelHelper::getDataFromSetting('rental_aggrement_receiving_mail');
                        $admin_subject="Rental Agreement in ".$property->name;
                        MailHelper::emailSenderByController($html,$to,$admin_subject);
                        return redirect()->to('booking/payment/paypal/'.$booking->id);
                    }
                }else{
                    return redirect()->to('booking/payment/paypal/'.$booking->id)->with("danger","Rental Agreement already submitted");
                }
            }
        }
        return abort(404);
    }

    public function notfound(){
        return view("errors.404");
    }

    function sitemap(){
        $cms=Cms::all();    $blogs=Blog::all();    $blogcategories=BlogCategory::all();
        return response()->view("front.sitemap",compact("cms","blogs","blogcategories"))->header('Content-Type', 'text/xml');
    }
}