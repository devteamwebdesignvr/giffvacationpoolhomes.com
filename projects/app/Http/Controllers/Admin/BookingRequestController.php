<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Helper\Upload;
use Validator;
use MailHelper;
use LiveCart;
use App\Models\HostFully\HostFullyProperty;
use HostFully;
use ModelHelper;

class BookingRequestController extends Controller{
    
    public function __construct(BookingRequest $model){
        $this->model=$model;
        $this->admin_base_url="booking-enquiries.index";
        $this->admin_view="admin.booking-enquiries";
    }
    
    function getCheckinCheckoutDataGaurav(Request $request){
        $new_data_blocked=LiveCart::iCalDataCheckInCheckOut($request->id);
        $checkin=$new_data_blocked['checkin'];
        
        $checkout=$new_data_blocked['checkout'];
        
        return response()->json($new_data_blocked);
    }

    
    public function index(){
        $data=$this->model::orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }

    
    public function create(){
        return view($this->admin_view.".create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
           
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        
        //dd($data);
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"booking-enquiries");
        }
        if ($request->hasFile("bannerImage")) {
            $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"booking-enquiries");
        }
        $data=$this->model::create($data);
        
        return redirect()->route('booking-enquiry-confirm',$data->id)->with("success","Successfully Added");
    }

  
    public function show($id){
        return redirect()->route($this->admin_base_url);
    }

   
    public function edit($id){
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data"));
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

  
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
           
        ]);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("image")) {
                $data['image'] = Upload::fileUpload($request->file("image"),"booking-enquiries");
            }
            if ($request->hasFile("bannerImage")) {
                $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"booking-enquiries");
            }
            $this->model::find($id)->update($data);
            return redirect()->route($this->admin_base_url)->with("success","Successfully Updated");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function destroy($id){
        $exist=$this->model::find($id);
        if($exist){
            $exist->booking_status='booking-cancel';
            $exist->save();
             
            $data=BookingRequest::find($id)->toArray();
            if($data){
                $property=HostFullyProperty::find($data['property_id']);
                if($property){
                    $booking=BookingRequest::find($id);
                     $main_data=(HostFully::cancelLeadDataNew($booking->uid,$booking->propertyUid,$booking->checkin,$booking->checkout,$booking->email,$booking->name,$booking->adults,$booking->child,$booking->mobile));
                        if($main_data['status']==200){
                            BookingRequest::find($id)->update($main_data['data']);
                        }
                    //LiveCart::getFileIcalFileData($data['property_id']);
                    
                     $data=BookingRequest::find($id)->toArray();
                    $html= view("mail.booking-cancel-admin-email",compact("data","property"))->render();
                    $to=ModelHelper::getDataFromSetting('cancel_receiving_mail');
                    $admin_subject="Booking Cancelled for ".$property->name;
        
                    MailHelper::emailSenderByController($html,$to,$admin_subject);
                    
                    
                    $html= view("mail.booking-cancel-user-email",compact("data","property"))->render();
                    $to=$data['email'];
                    $user_subject="Booking Cancelled for ".$property->name;
        
                    MailHelper::emailSenderByController($html,$to,$user_subject);
                    
                    
                }
            }
                    
                
            
            return redirect()->route($this->admin_base_url)->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }


    function confirmed($id){
        $exist=$this->model::find($id);
        if($exist){
            $property=HostFullyProperty::find($exist->property_id);
            if($property){
                $data=$exist->toArray();
                $html=view("mail.booking-confirmation-user-email",compact("data","property"))->render();
                $to=$exist->email;
                $customer_subject="Payment Request for ".$property->name;
                
                MailHelper::emailSenderByController($html,$to,$customer_subject);
                $exist->booking_status='rental-aggrement';
                $exist->save();
                return redirect()->route($this->admin_base_url)->with("success","Successfully send");
            }
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
}
