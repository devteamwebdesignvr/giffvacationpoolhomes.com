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
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
	<!-- start banner sec -->
    <a href="#check" class="sticky main-btn book1 check">
CHECK AVAILABILITY
</a>
  
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
	<!-- end banner sec -->
@php
    $list=App\Models\HostFully\HostFullyProperty::query();
    $total_sleep=0;
    if(Request::get("Guests")){
        
        if(Request::get("adults")!=""){
        //dd(var_dump(Request::get("adults")));
            if(is_int((int)Request::get("adults"))){
                $total_sleep+=Request::get("adults");
            }
        }
        if(Request::get("child")!=""){
            if(is_int((int)Request::get("child"))){
                $total_sleep+=Request::get("child");
            }
        }
    }
    $yes_is_pet='';
    $no_is_pet='';
    
    if(Request::get("is_pet")){
        if(Request::get("is_pet")=="Yes"){
            $list->where("pet_fee",">",0);
            $yes_is_pet="checked";
        }else{
            $no_is_pet="checked";
        }
    }else{
        $no_is_pet="checked";
    }
    if(Request::get("start_date")){
        if(Request::get("end_date")){
            
           
            $ids=Helper::getPropertyList(Request::get("start_date"),Request::get("end_date"),$total_sleep);
            $list->whereIn("uid",$ids);
            $days=Helper::calculateDays(Request::get("start_date"),Request::get("end_date"));
            
            $list->where("minimumStay","<=",$days);
            
        }
    }
    if($total_sleep>0){
        $list->where("maxGuests",">=",$total_sleep);
    }
  
    $list=$list->where(["isActive"=>"1","status"=>"true"])->orderBy("id","desc")->paginate(20);
@endphp


<section class="property-list-sec">
    <div class="container">
        <div class="row frs">
            <div class="main left">
                <div class="property-list-box">
                    @foreach($list as $c)
                     @php 
                        $images = [];
                        $i=0;
                       /** if($data->pictureLink){
                          $images[$i]['url'] = $data->pictureLink;
                          $images[$i]['description'] = $data->name;
                        } **/
                        $imageList = App\Models\HostFully\HostFullyPropertyPhoto::where("property_uid",$c->uid)->orderBy("displayOrder","asc")->get();                  
                        if(count($imageList)>0){
                         foreach($imageList as $img){
                           if($i==0){
                  			  $images[] = $img;	
                           }
                           $i++; 
                         }
                        }
                       @endphp
                        <div class="property-lt-box">
                            <div class="pro-list-left">
                                <div class="pro-img-part">
                                    @if(isset($images))
                                        <a href="{{ url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all()) }}">
                                            <img src="{{($images[0]['url'])}}" alt="{{$images[0]['description']}}" class="img=fluid"/>
                                        </a>
                                    @endif
                                </div>
                                <div class="about-pro-list">
                                    <div class="pro-list-details">
                                        <div class="vacation-content pro-list-name">
                                            <a href="{{ url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all()) }}"><h3>{{$c->name}}</h3></a>
                                            @if($c->address1)
                                                <h4 class="d-none"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$c->address1}} {{ $c->address2 }}</h4>
                                            @endif
                                        </div>
                                        @php
                                            $description=App\Models\HostFully\HostFullyPropertyDescription::where(["property_uid"=>$c->uid])->first();
                                        @endphp
                                        @if($description)
                                            <p class="descr">{{$description->shortSummary}}</p>
                                        @endif
                                        <div class="pro-list-dec">
                                            @if($c->maxGuests)
                                                <p class="adult"><i class="fa-solid fa-users"></i>{{$c->maxGuests}} Sleeps</p>
                                            @endif
                                            @if($c->bedrooms)
                                                <p class="pool"><i class="fa-solid fa-home"></i>{{$c->bedrooms}} Bedrooms</p>
                                            @endif
                                            @if($c->beds)
                                                <p class="pool"><i class="fa-solid fa-bed"></i>{{$c->beds}} Beds</p>
                                            @endif
                                            @if($c->bathrooms)
                                                <p class="bed"><i class="fa-solid fa-bath pe-1"></i>{{$c->bathrooms}} Baths</p>
                                            @endif
                                            @if($c->area_size)
                                                <p class="size"><i class="fa-solid fa-maximize pe-2"></i>Size {{$c->area_size}} {{$c->area_unitType }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pro-list-btn-sec">
                                        @if($c->dailyRate)
                                            <div class="pro-rates" style="display:none;">
                                                <p>Price starts at:</p>
                                                <p class="pro-list-price">
                                                    <span class="doller">{!! $c->currency !!}</span><span>{{$c->dailyRate}}</span> / Night
                                                </p>
                                            </div>
                                        @endif
                                        <div class="pro-list-btns">
                                            <a href="{{ url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all()) }}" class="main-btn mt-4" role="button">
                                                <span class="content-wrapper">
                                                    <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                                                    <span class="button-text">Details</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endforeach
                  @if(count($list)==0) 
                     <p class="text-center">Sorry, we couldn’t find any properties that match your search.</p>           
                  @endif
                </div>
            </div>
            <div class="sidebar right" id="check">
                 <div class="sidebar-container">
                   <div class="forms-booking-tab">
                      <ul class="tabs">
                         <li class="booking" data-form="ovabrw_booking_form">Get Quote</li>
                      </ul>
                      <div class="ovabrw_booking_form ovabrw-booking " id="ovabrw_booking_form" style="">
                         <form class="form booking_form booking_form1" id="booking_form" action="" method="get">
                            <div class="ovabrw-container wrap_fields">
                               <div class="ovabrw-row">
                                  <div class="wrap-item two_column">
                                     <!-- Display Booking Form -->
                                     <div class="rental_item">
                                        <label>Check in</label>
                                        <div class="ovabrw_datetime_wrapper">
                                           {!! Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in"]) !!}
                                           <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                     </div>
                                     <div class="rental_item">
                                        <label> Check out </label>
                                        <div class="ovabrw_datetime_wrapper">
                                           {!! Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out" ]) !!}
                                           <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                     </div>
                                     <div class="ovabrw_service_wrap">
                                        <label> Guests </label>
                                        <div class="row ovabrw_service">
                                           <div class="ovabrw_service_select rental_item">
                                               <input type="text" name="Guests" value="{{ Request::get('Guests') ?? '1 Guests' }}" readonly class="form-control gst" id="show-target-data" placeholder="Guests">
                                                <i class="fa-solid fa-users "></i>
                                                <input type="hidden" value="{{ Request::get('adults') ?? '1' }}" name="adults" id="adults-data" />
                                                <input type="hidden" value="{{ Request::get('child') ?? '0' }}" name="child" id="child-data" />
                                                <div class="adult-popup">
                    	                          <div class="modal-bodyss" id="guestsss">
                    	                          		<p class="close1" onclick=""><i class="fa fa-times"></i></p>
                    	                               <div class="ac-box">
                    	                                  <div class="adult">
                    	                                     <span id="adults-data-show">
                    	                                         @if(Request::get('adults'))
                    	                                            @if(Request::get('adults')>1)
                    	                                                {{ Request::get('adults') }} Adults
                    	                                            @else
                    	                                                {{ Request::get('adults') }} Adult
                    	                                            @endif
                    	                                         @else
                    	                                          1 Adult
                    	                                         @endif
                    	                                     </span>
                    	                                     <p>(18+)</p>
                    	                                  </div>
                    	                                  <div class="btnssss">
                    	                                     <div class="button button1 btnnn" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Increment Value">-</div>  
                    	                                     <div class="button11 button1" onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</div>
                    	                                  </div>
                    	                               </div>
                    	                                <div class="ac-box">
                    	                                  <div class="adult">
                    	                                     <span id="child-data-show">
                    	                                          @if(Request::get('child'))
                    	                                            @if(Request::get('child')>1)
                    	                                                {{ Request::get('child') }} Children
                    	                                            @else
                    	                                                {{ Request::get('child') }} Child
                    	                                            @endif
                    	                                         @else
                    	                                         Child
                    	                                         @endif
                    	                                     </span>
                    	                                     <p>(0-17)</p>
                    	                                  </div>
                    	                                  <div class="btnssss btnsss">
                    	                                     <div class="button button1" onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Increment Value">-</div> 
                    	                                     <div class="button11 button1" onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</div>
                    	                                  </div>
                    	                               </div>
                    	                               @if(App\Models\Property::where(["status"=>"true"])->count()>1)
                                        	            <div class="ac-box">
                                                          <div class="adult">
                                                             <span id="child-data-show">Pet</span>
                                                          </div>
                                                          <div class="btnsssss btnsss">
                                                             <input type="radio" id="pet1" name="pet" value="Yes"  {{ $yes_is_pet }}>
                                                            <label for="pet1">Yes</label>
                                                            <input type="radio" id="pet2" name="pet" value="No"  {{ $no_is_pet }}>
                                                            <label for="pet2">No</label> 
                                                          </div>
                                                       </div>
                                                       @endif
                    	                               <button type="button" class="btn main-btn close1" data-dismiss="modal" onclick="">Apply</button>
                    	                           </div>
                    	                      </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="booking-error"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ovabrw-book-now">
                                       <button type="button" id="reset-button-gaurav-data" class="main-btn">
                                       Reset</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="ovabrw-book-now">
                                       <button type="submit" class="main-btn">
                                       Submit</button>
                                    </div>
                                </div>
                            </div>
                         </form>
                      </div>
                   </div>
                 </div>
              </div>
        </div>
    </div>
</section>
@stop
@section("js")
<script>    
    function functiondec($getter_setter,$show,$cal){  console.log($getter_setter,$show,$cal);
        val=parseInt($($getter_setter).val());
        if(val>0){
            val=val-1;
        }
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        $($show).val($show_actual_data);
    }
    function functioninc($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());        
            val=val+1;       
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        $($show).val($show_actual_data);
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
    }
    
    $("#reset-button-gaurav-data").click(function(){
        $("#txtFrom").val('');
        $("#txtTo").val('');
        $("#adults-area").val('');
        $("#child-area").val('');
        $("#adults-data").val(0);
        $("#child-data").val(0);
        $("#show-target-data").val(null);
        $("#submit-button-gaurav-data").hide();
        $("#gaurav-new-modal-days-area").html('');
        $("#gaurav-new-modal-service-area").html('');
        $("#gaurav-new-data-area").html('');
        $("#adults-data-show").html("Adult");
        $("#child-data-show").html("Child");
        $("#txtFrom").datepicker("option", "maxDate",  '2043-10-10');
    });
</script>
@php $checkin=[];$checkout=[];@endphp
<script type="text/javascript">
    var checkin = <?php echo json_encode($checkin);  ?>;
    var checkout = <?php echo json_encode($checkout);  ?>;
    $(function() {
        $("#txtFrom").datepicker({
            numberOfMonths: 1,
            minDate: '@minDate',
               maxDate:"{{ date('Y-m-d', strtotime('+2 year')) }}",
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkin.indexOf(string) == -1];
            },
            onSelect: function(selected) {
                $("#submit-button-gaurav-data").hide();
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#txtTo").datepicker("option", "minDate", dt);
                $("#txtTo").val('');
            },
            onClose: function() {
                $("#txtTo").datepicker("show");
            }
        });

        $("#txtTo").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd', 
               maxDate:"{{ date('Y-m-d', strtotime('+2 year')) }}",
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkout.indexOf(string) == -1]
            },
            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#txtFrom").datepicker("option", "maxDate", dt);
                $.post("{{route('checkajax-get-quote')}}",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),book_sub:true,property_id:{{ $data->id }}},function(data){
                    if(data.status==400){
                        $("#submit-button-gaurav-data").hide();
                        toastr.error(data.message);
                    }else{}
                });
            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });
</script>
@stop