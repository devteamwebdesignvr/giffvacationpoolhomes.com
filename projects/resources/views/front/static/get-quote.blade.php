@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("container")
    @php
        $name=$data->name;
        $bannerImage=asset('front/images/breadcrumb.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
    <!-- start banner sec -->

    <section class="page-title" style="background-image: url({{$bannerImage}});">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate">{{$name}}</h1>
            <div class="checklist">
                <p>
                    <a href="{{url('/')}}" class="text"><span>Home</span></a>
                    <a class="g-transparent-a">{{$name}}</a>
                </p>
            </div>
        </div>
    </section>
	<!-- start about section -->
   @php
        $start_date=Request::get("start_date");
        $end_date=Request::get("end_date");
        $adults=Request::get('adults');
        $child=Request::get('child');
        $total_guests=$adults+$child;
       
        
        $total_guests=$adults+$child;
       
        
    @endphp

    @php
    $total_guests=Request::get('adults')+Request::get('child');


    $now = strtotime(Request::get("start_date")); 
      $your_date = strtotime(Request::get("end_date"));
      $datediff =  $your_date-$now;
      $day= ceil($datediff / (60 * 60 * 24));
     $total_night=$day;

     $sign=$property->currencyCode;
     $base_price=0;
     $curr=$main_data['quote']['currencySymbol'];



@endphp

  <section class="get-quote-sec">
       <div class="container">
           <div class="row">
              <div class="col-md-12 text-center">
                  <h2>{{$property->name ?? ''}} : Booking Quote</h2>
              </div>
            </div>
            <div class="table-box">
            <table class="table table-bordered">
            <tr>
              <th>Check In</th>
              <th>Check Out</th>
              <th>Total Guests</th>
              <th>Total Nights</th>
              <th   align="right" style="text-align: right !important;">Amount</th>
           </tr>
            <tr>
              <td>{{date('F jS, Y',strtotime($start_date))}}</td>
              <td>{{date('F jS, Y',strtotime($end_date))}}</td>
              <td>{{$total_guests}} Guests   ({{ $adults }} Adults , {{ $child }} Child)</td>
              <td>{{$day}}</td>
              <td  align="right">{!! $curr !!} {{number_format($main_data['quote']['rent']['rentNetPrice'],2)}}</td>
           </tr>
           @php
            //dd($main_data);
           @endphp
            
         
           @if($main_data['quote']['rent']['extraGuestsNetPrice']!=0)
           <tr>
               <td colspan="4">Extra Guests Fee</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['rent']['extraGuestsNetPrice'],2)}}</td>
           </tr>

           @endif

           
           @if($main_data['quote']['rent']['discount'])
            <tr>
               <td colspan="4">{{ $main_data['quote']['rent']['discount']['discountCode']  }} ({{ $main_data['quote']['rent']['discount']['discountType']  }})</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['rent']['discount']['amount'],2)}}</td>
           </tr>
           @endif


         
           @if($main_data['quote']['rent']['taxAmount']!=0)
           <tr>
               <td colspan="4">Tax Amount</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['rent']['taxAmount'],2)}}</td>
           </tr>

           @endif
         
           @if($main_data['quote']['rent']['grossPrice']!=0)
           <tr>
               <td colspan="4">Gross Amount</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['rent']['grossPrice'],2)}}</td>
           </tr>

           @endif
           <tr>
               <td colspan="4">Cleaning Fee</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['fees']['cleaningFee']['grossPrice'],2)}}</td>
           </tr>
        
        
        
        @foreach($main_data['quote']['fees']['otherFees'] as $c)
           <tr>
               <td colspan="4">{{ ucfirst($c['name'])}}</td>
               <td align="right">{!! $curr !!} {{number_format($c['grossPrice'],2)}}</td>
           </tr>
        
          @endforeach
        
   
        
            @if($main_data['quote']['includeSecurityDepositInTotal']==false)

           <tr>
               <td colspan="4">Total Amount</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['totalAmount'],2)}}</td>
           </tr>

              <tr>
               <td colspan="4">Security Deposit Amount</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['securityDeposit'],2)}}</td>
           </tr>
           <tr>
               <td colspan="4">Amount to Pay</td>
               <td align="right">{!! $curr !!} {{number_format(($main_data['quote']['totalAmount']+$main_data['quote']['securityDeposit']),2)}}</td>
           </tr>

           @else
              <tr>
               <td colspan="4">Security Deposit Amount</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['securityDeposit'],2)}}</td>
           </tr>
           <tr>
               <td colspan="4">Amount to Pay</td>
               <td align="right">{!! $curr !!} {{number_format($main_data['quote']['totalAmount'],2)}}</td>
           </tr>
            @endif
    
        
           
       </table>
        </div>
       {!! Form::open(["url"=>"save-booking-data","class"=>"","id"=>"save-booking-data"]) !!}
       
       
       

        <input type="hidden" name="amount_data" value="{{ json_encode($main_data) }}">
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        <input type="hidden" name="checkin" value="{{ Request::get('start_date') }}" >
        <input type="hidden" name="checkout" value="{{ Request::get('end_date') }}" >
        <input type="hidden" name="adults" value="{{ Request::get('adults') }}" >
        <input type="hidden" name="child" value="{{ Request::get('child') }}" >
        <input type="hidden" name="total_guests" value="{{ $total_guests }}" >
        <input type="hidden" name="total_night" value="{{ $total_night }}" >

        @php
                $next_payment_interval=0;
                $next_payment_date=null;
                $percentUponReservation=0;
              
        @endphp
        <input type="hidden" name="next_payment_interval" value="{{ $next_payment_interval }}" >
        <input type="hidden" name="next_payment_date" value="{{ $next_payment_date }}" >
        <input type="hidden" name="percentUponReservation" value="{{ $percentUponReservation }}" >

     
  
        <input type="hidden" name="request_id" value="{{ uniqid() }}" >
        <div class="row">
            <div class="col-md-12">
                 <div class="row">
                
                     <div class="col-md-12 check-box">
                        <div class="form-group">
                            <input type="checkbox" id="pet-required" name="is_pet" value="yes">
                            <label for="pet-required"> Pet</label>
                            <div class="pet-drop">
                                <label for="pet-no">Number of pets</label>

                                <select name="pet_no" id="pet-no">
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                    <div class="col-md-12 pet-data-one" style="display:none">
                        <div class="form-group">
                            {!! Form::label("first_pet_weight") !!}
                            {!! Form::text("first_pet_weight",null,["class"=>"form-control pet-data pet-one","placeholder"=>"Enter First Pet Weight"])!!}
                        </div>
                    </div>
                  
                    <div class="col-md-12 pet-data-two" style="display:none">
                        <div class="form-group">
                            {!! Form::label("second_pet_weight") !!}
                            {!! Form::text("second_pet_weight",null,["class"=>"form-control pet-data pet-two","placeholder"=>"Enter Second Pet Weight"])!!}
                        </div>
                    </div>
                  
          
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label("first Name") !!}
                            {!! Form::text("firstName",null,["class"=>"form-control","required","placeholder"=>"Enter First Name"])!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label("last Name") !!}
                            {!! Form::text("lastName",null,["class"=>"form-control","required","placeholder"=>"Enter Last Name"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("email") !!}
                            {!! Form::email("email",null,["class"=>"form-control","required","placeholder"=>"Enter email"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("mobile") !!}
                            {!! Form::text("mobile",null,["class"=>"form-control","placeholder"=>"Enter mobile"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("message") !!}
                            {!! Form::textarea("message",null,["class"=>"form-control","placeholder"=>"Enter message","rows"=>"2"])!!}
                        </div>
                    </div>
                </div>
                <div class="row text-center mt-4 bttn">
                    @if($property->instant_booking_button=="true")
                    <div class="">
                        <div class="form-group">
                            <button type="submit" class=" btn-success main-btn" name="operation" value="send-quote">Submit Request</button>
                        </div>
                    </div>
                      @endif
                    <div class="">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class=" btn-success main-btn pay" name="operation" value="direct-booking">Pay Now</button>
                        </div>
                    </div>
                  
                </div>
           
        </div>
       {!! Form::close() !!}
       </div>
   </section>
@stop

@section("js")
<script>
    $(document).on("change","#is_coupon",function(){
        if($(this).prop("checked")==true){
            $("#coupon-form").show();
        }else{
            $("#coupon-form").hide();
        }
    });
    $(function(){
        @if(Request::get("coupon"))
            $("#is_coupon").prop("checked","true");
            $("#coupon-form").show();
        @endif
    })
</script>
 <script>
    $(document).on("change","#pet-required",function(){
        if($(".pet-drop").hasClass("data-new-one")){
            $(".pet-data-two").hide();
            $(".pet-two").attr("required",false);
            $(".pet-data-one").hide();
            $(".pet-one").attr("required",false);
            $(".pet-drop").hide();
            $(".pet-drop").removeClass("data-new-one");
        }else{
            $(".pet-drop").addClass("data-new-one");
            $(".pet-drop").show();
        }
    });
    $(document).on("change","#pet-no",function(){
        $(".pet-data-two").hide();
        $(".pet-two").attr("required",false);
        $(".pet-data-one").hide();
        $(".pet-one").attr("required",false);
        var pet_no=$(this).val();
        if(pet_no==1){
            $(".pet-data-one").show();
            $(".pet-one").attr("required",true); 
        }
        if(pet_no==2){
            $(".pet-data-two").show();
            $(".pet-two").attr("required",true);
            $(".pet-data-one").show();
            $(".pet-one").attr("required",true); 
        }
    });
</script>
@stop