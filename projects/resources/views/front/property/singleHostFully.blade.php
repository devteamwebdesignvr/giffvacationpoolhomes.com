@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("header-section")
   {!! $data->header_section !!}
@stop

@section("css")
   <link href="{{asset('front/royalslider.css')}}" rel="stylesheet">
   <link href="{{asset('front/rs-defaulte166.css')}}" rel="stylesheet">
@stop
@section("container")
@php
   $name=$data->name;
   $bannerImage=asset('front/images/internal-banner.webp');;
@endphp
   <style>pre{   white-space: pre-line; word-break: break-word; font-family: var(--primary-font); font-size: 16px; text-align: justify;}</style>
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
   <a href="#book" class="sticky main-btn book1">BOOK NOW</a>
   <section id="property" class="padding_top padding_bottom_half">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 listing1 property-details">
               <div class="upper-box">
                   <div class="row">
                       <div class="col-lg-9 col-md-10 col-8 col-sm-8">
                           @php $reviews=$data->reviews;@endphp
                           @if($reviews)
                              <div class="rating" data-aos="fade-up" data-aos-duration="1500">
                                  @php $reviews=json_decode($data->reviews,true);@endphp
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  {{ $reviews['total'] ?? '0' }}+ Review
                              </div>
                           @endif
                           <h3 data-aos="fade-right" data-aos-duration="1500">{{$data->name}}</h3> 
                           <div class="hotel-info d-none" data-aos="fade-up" data-aos-duration="1500">
                              <i class="fas fa-map-marker-alt"></i>{{$data->address1}} {{$data->address2}}
                           </div>
                       </div>
                       <div class="col-lg-3 col-md-2 col-4 col-sm-4">
                            <div class="price" style="display:none;">
                                {!! $data->currency !!}{{$data->dailyRate}} <span>/ Night</span>
                            </div>
                       </div>
                   </div>
                    <ul class="food-list" data-aos="fade-up" data-aos-duration="1500">
                       <li><i class="fa fa-bed" aria-hidden="true"></i>  {{$data->beds}} Beds</li>
                       <li><i class="fa fa-home" aria-hidden="true"></i>  {{$data->bedrooms}} Bedrooms</li>
                       <li><i class="fa fa-bathtub" aria-hidden="true"></i>  {{$data->bathrooms}} Bathrooms</li>
                       <li><i class="fa fa-users" aria-hidden="true"></i>  {{$data->maxGuests}} Sleeps </li>
                       <li><i class="fa-solid fa-maximize pe-2"></i> Size {{$data->area_size}} {{ str_replace("_"," ",$data->area_unitType) }}</li>
                   </ul>
               </div>
                 @php 
                  $images = [];
                  $i=0;
                 /** if($data->pictureLink){
                    $images[$i]['url'] = $data->pictureLink;
                    $images[$i]['description'] = $data->name;
                  } **/
                  $imageList = App\Models\HostFully\HostFullyPropertyPhoto::where("property_uid",$data->uid)->orderBy("displayOrder","asc")->get();                  
                  if(count($imageList)>0){
                   foreach($imageList as $img){
                     $images[] = $img;
                   }
                  }
                 @endphp
               <section class="blog-details-area ptb-90">
                  <div class="container-fluid" style="" id="calender_nrj">
                     <div class="row">
                        <div class="col-md-12 col-xs-12 col-lg-12  col-sm-12 main-content"style="padding-right: 0px;padding-left: 0px;">
                           <div  class="page wrapper main-wrapper">
                              <div class="row clearfix">
                                 <div class="col span_6 fwImage"style="text-align: center;">
                                    <div id="gallery-1" class="royalSlider rsDefault">
                                          @foreach($images as $c)
                                             <a class="rsImg"   data-rsBigImg="{{asset($c['url'])}}" href="{{asset($c['url'])}}">
                                                <img width="126" height="82" class="rsTmb" src="{{asset($c['url'])}}" alt="{{$c['description']}}"/>
                                                <span>{{$c['description']}}</span>
                                             </a>
                                          @endforeach     
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  @php $description=App\Models\HostFully\HostFullyPropertyDescription::where(["property_uid"=>$data->uid])->first();@endphp
                  @if($description)
                  <div class="property_meta">
                     <div class="propert-box-sec">
                        <div class="tab-content">
                           <h3 class="heading-2">Overview</h3>
                        </div>
                        <hr class="hr">
                     </div>
                     <div class="overview-content">
                        {!! $description->summary !!}
                     </div>
                     <div class="cta-btn" id="overview-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="overview-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                     @if($description->space)
                       <div class="propert-box-sec mt-4">
                           <div class="tab-content">
                              <h3 class="heading-2">space</h3>
                           </div>
                           <hr class="hr">
                        </div>
                        <div class="space-content">
                        <pre>{!! $description->space !!}</pre>
                     </div>
                       <div class="cta-btn" id="space-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="space-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                     @endif
                  </div>
                 @endif
                  <div id="amenities" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-30">
                        <div class="tab-content">
                           <h3 class="heading-2">Amenities</h3>
                        </div>
                        <hr class="hr">
                        <div class="amenities-content">
                        <div class="row">
                           @foreach(App\Models\HostFully\HostFullyPropertyAmenity::where("property_uid",$data->uid)->get() as $c1)
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <ul class="amenities">
                                    <li><i class="fa fa-check"></i> {{ Helper::camelCaseToSnakeCase($c1['amenity']) }}</li>
                                 </ul>
                              </div>
                           @endforeach
                           @foreach(App\Models\HostFully\HostFullyPropertyCustomAmenity::where("property_uid",$data->uid)->get() as $c1)
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <ul class="amenities">
                                 <li><i class="fa fa-check"></i> {{ $c1->name}}</li>
                              </ul>
                           </div>
                           @endforeach
                        </div>
                        </div>
                        <div class="cta-btn" id="amenities-more">
                        <a class="main-btn mt-4">Show All</a>
                     </div>
                     <div class="cta-btn" id="amenities-less">
                        <a class="main-btn mt-4">Show Less</a>
                     </div>
                     </div>
                  </div>
                  @if($description)
                     <div class="property_meta">
                        @if($description->notes)
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">Notes</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          
                           <div class="notes-content">
                        <pre>{!! $description->notes !!}</pre>
                     </div>
                       <div class="cta-btn" id="notes-more">
                        <a class="main-btn mt-4">Read More</a>
                     </div>
                     <div class="cta-btn" id="notes-less">
                        <a class="main-btn mt-4">Read Less</a>
                     </div>
                        @endif
                        @if($description->houseManual)
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">House manual</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre>{!! $description->houseManual !!}</pre>
                        @endif
                        @if($description->access)
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">Access</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre>{!! $description->access !!}</pre>
                        @endif
                        @if($description->interaction)
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">interaction</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre>{!! $description->interaction !!}</pre>
                        @endif
                        @if($description->neighbourhood)
                          <div class="propert-box-sec mt-4">
                              <div class="tab-content">
                                 <h3 class="heading-2">neighbourhood</h3>
                              </div>
                              <hr class="hr">
                           </div>
                          <pre>{!! $description->neighbourhood !!}</pre>
                        @endif
                     </div>
                  @endif
                  <div id="availability" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-40">
                        <h3 class="heading-2">Availability</h3>
                        <hr class="hr">
                     </div>
                     <div class="calender">
                         <iframe src="{{ url('fullcalendar-demo/'.$data->id) }}"  width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                  </div>
                   @if(App\Models\HostFully\HostFullyPropertyReview::where("property_uid",$data->uid)->count()>0)
                     <div id="reviews" class="abouttext" style="margin-top: 30px;">
                        <div class="inside-properties mb-50">
                           <div class="tab-content">
                              <h3 class="heading-2">Review</h3>
                           </div>
                           <hr class="hr">
                           <div class="comments">
                              <div class="comment">
                                 @foreach(App\Models\HostFully\HostFullyPropertyReview::where("property_uid",$data->uid)->orderBy("id","desc")->get() as $c)
                                    <div class="comment-content">
                                       <div class="comment-meta">
                                          @if($c->title)
                                             <h3 style="margin-bottom: 18px;">{{$c->title}}</h3>
                                          @endif
                                          @if($c->rating)
                                             <span style="font-size: 14px;">{{ $c->rating }}/5</span>
                                             @for($i=0;$i<=$c->rating;$i++)
                                                <span class="fa fa-star checked"></span>
                                             @endfor
                                          @endif
                                       </div>
                                       <div class="comment-meta" style="margin-top: 18px;">
                                          <h3 style="">{{$c->author}}</h3>
                                       </div>
                                       <p style="font-size: 14px;line-height: 20px;margin-top: 18px;"></p>
                                       <p>{!! $c->content !!}</p>
                                       <span style="font-size: 14px;font-weight: 500;">Stayed {{date('F Y',strtotime($c->date))}}</span>
                                    </div>
                                    <hr class="hr">
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     </div>
                  @endif
               </div>
               <div class="col-lg-4" id="book">
                   <div class="get-quote">
                       {!! $data->bookng_widget !!}
                       {{--
                       <div class="forms-booking-tab">
                          <ul class="tabs">
                             <li class="item booking active" data-form="ovabrw_booking_form">Request A Quote</li>
                          </ul>
                          <div class="ovabrw_booking_form" id="ovabrw_booking_form" style="">
                             <form class="form booking_form" id="booking_form" action="{{ url('get-quote') }}" method="get" >
                                 <input type="hidden" name="property_id" value="{{ $data->id }}">

                                <div class="ovabrw_datetime_wrapper">
                                    {!! Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in"]) !!}
                                   <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div class="ovabrw_datetime_wrapper">
                                   {!! Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out"]) !!}
                                   <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                
                                @if($data->uid)
                                    @php $pet_data=App\Models\HostFully\HostFullyPropertyRule::where("propertyUid",$data->uid)->where("rule","ALLOWS_PETS")->first(); @endphp
                                    @if($pet_data)
                                    <div class="row">     
                                         <div class="col-md-12 pets d-none" style="">
                                             {!! Form::selectRange("pet",0,2,null,["class"=>"form-control","style"=>"border: 1px solid #cacaca;margin-top: 0px;","id"=>"pet_fee_data_guarav","placeholder"=>"Pets"]) !!}
                                             <i class="fa-solid fa-paw"></i>
                                         </div>
                                     </div>
                                    @endif
                                @endif
                                <div class="ovabrw_service_select rental_item">
                                     <input type="text" name="Guests" required value="{{ Request::get('Guests') ?? '1 Guests' }}" readonly class="form-control gst" id="show-target-data" placeholder="Guests">
                               
                                          
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
                                                         @if(Request::get('adults'))
                                                           @if(Request::get('adults')>1)
                                                               {{ Request::get('adults') }} Children
                                                           @else
                                                               {{ Request::get('adults') }} Child
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
                                              <button type="button" class="btn main-btn close1" data-dismiss="modal" onclick="">Apply</button>
                                          </div>
                                     </div>
                                   <i class="fa-solid fa-users"></i>
                                </div>
                                 <div id="gaurav-new-data-area"></div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="ovabrw-book-now" >
                                            <button type="button" class="main-btn"  id="reset-button-gaurav-data">
                                             Reset</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ovabrw-book-now"  id="submit-button-gaurav-data1">
                                            <button type="submit" class="main-btn">
                                             Reserve</button>
                                        </div>
                                    </div>
                                 </div>
                                 <p>Or<br>Contact Owner</p>
                                 <p><a href="mailto:{!! $setting_data['email'] ?? '#' !!}"><i class="fa-solid fa-envelope"></i> {!! $setting_data['email'] ?? '#' !!}</a></p>
                              </form>
                           </div>
                        </div>
                        --}}
                     </div>
                  </div>
               </div>
            </div>
      </section>

@if($data->footer_section)

     <section class="attraction-sec">
        <div class="container">
            {!!  $data->footer_section !!}
        </div>
    </section>
@endif
   @if($data->map)
      <div class="map" id="#map">
          <iframe src="{!! $data->map !!}" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
   @endif
@stop

@section("js")  
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="gaurav-new-modal-days-area">
        Modal body..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Additional Fee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="gaurav-new-modal-service-area">
        Modal body..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('front/jquery.royalslider.minf76d.js')}}"></script> 
<script src="https://rawgit.com/jedfoster/Readmore.js/master/readmore.js"></script>
<script>
    function functiondec($getter_setter,$show,$cal){
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
        ajaxCallingData();
    }
    function functioninc($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        person2=parseInt($($cal).val());
         if((val+person2)<{{  $data->maxGuests }}){
            val=val+1;
         }
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
        ajaxCallingData();
    }

  $('.more').readmore({speed: 75, collapsedHeight:312, moreLink: '<a class="ac" href="#">Show more</a>', lessLink: '<a class="kapat" href="#">Show Less</a>', });
</script>

<script src="{{ asset('front/js/showmore.js')}}"></script>

<script>
   $(function(){ $(".datepicker").datepicker();});
   @php $new_data_blocked=LiveCart::iCalDataCheckInCheckOut($data->uid);$checkin=$new_data_blocked['checkin'];$checkout=$new_data_blocked['checkout'];@endphp
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
                return [checkout.indexOf(string) == -1];
            },
            onSelect: function(selected) {
               var dt = new Date(selected);
               dt.setDate(dt.getDate() - 1);
               $("#txtFrom").datepicker("option", "maxDate", dt);
               ajaxCallingData();
            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });

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
      $("#pet_fee_data_guarav").val(0)
      $("#txtFrom").datepicker("option", "maxDate",  '2043-10-10');
   });
                       
   @if(Request::get("start_date"))
      @if(Request::get("end_date"))
         $(document).ready(function(){ajaxCallingData();});     
      @endif
   @endif
    
    $(document).on("change","#pet_fee_data_guarav",function(){
        ajaxCallingData();
    });
    
    function ajaxCallingData(){
        // pet_fee_data_guarav=$("#pet_fee_data_guarav").val()
        // adults=$("#adults-data").val();
        // childs=$("#child-data").val();
        //  if($("#txtFrom").val()!=""){
        //      if($("#txtTo").val()!=""){
        //          $.post("{{route('checkajax-get-quote')}}",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),pet_fee_data_guarav:pet_fee_data_guarav,adults:adults,childs:childs,book_sub:true,property_id:{{ $data->id }}},function(data){
        //             if(data.status==400){
        //                 $("#submit-button-gaurav-data").hide();
        //                 toastr.error(data.message);
        //             }else{
        //                 $("#submit-button-gaurav-data").show();
        //                 $("#gaurav-new-modal-days-area").html(data.modal_day_view);
        //                 $("#gaurav-new-modal-service-area").html(data.modal_service_view);
        //                 $("#gaurav-new-data-area").html(data.data_view);
        //             }
        //         });
        //      }
        //  }                      
    }

   jQuery(document).ready(function($) {
      $('#gallery-1').royalSlider({
          fullscreen: {
              enabled: true,
              nativeFS: true
          },
          controlNavigation: 'thumbnails',
          autoScaleSlider: true, 
          autoScaleSliderWidth: 800,     
          autoScaleSliderHeight: 550,
          loop: true,
          imageScaleMode: 'fit-if-smaller',
          navigateByClick: true,
          numImagesToPreload:2,
          arrowsNav:true,
          arrowsNavAutoHide: true,
          arrowsNavHideOnTouch: true,
          keyboardNavEnabled: true,
          fadeinLoadedSlide: true,
          globalCaption: true,
          globalCaptionInside: false,
          thumbs: {
              appendSpan: true,
              firstMargin: true,
              paddingBottom: 4
          }
      });
      
      $('.rsContainer').on('touchmove touchend', function(){});
         
      $("#overview-more").click(function(){
         $("#overview-less").css("display", "block");
         $("#overview-more").css("display", "none");
         $(".overview-content").css("height", "100%");
      });
     
      $("#overview-less").click(function(){
         $("#overview-less").css("display", "none");
         $("#overview-more").css("display", "block");
         $(".overview-content").css("height", "230px");
      });
      if($(".overview-content").height() <= 230) {
             $("#overview-more").css("display", "none");
             $("#overview-less").css("display", "none");
        }
         else {
            $("#overview-more").css("display", "block");
            $(".overview-content").css("height", "230px");
        }
         $("#space-more").click(function(){
         $("#space-less").css("display", "block");
         $("#space-more").css("display", "none");
         $(".space-content").css("height", "100%");
      });
     
      $("#space-less").click(function(){
         $("#space-less").css("display", "none");
         $("#space-more").css("display", "block");
         $(".space-content").css("height", "265px");
      });
      if($(".space-content").height() <= 265) {
             $("#space-more").css("display", "none");
             $("#space-less").css("display", "none");
        }
         else {
            $("#space-more").css("display", "block");
            $(".space-content").css("height", "265px");
        }
        $("#amenities-more").click(function(){
         $("#amenities-less").css("display", "block");
         $("#amenities-more").css("display", "none");
         $(".amenities-content").css("height", "100%");
      });
     
      $("#amenities-less").click(function(){
         $("#amenities-less").css("display", "none");
         $("#amenities-more").css("display", "block");
         $(".amenities-content").css("height", "265px");
      });
      if($(".amenities-content").height() <= 265) {
             $("#amenities-more").css("display", "none");
        }
         else {
            $("#amenities-more").css("display", "block");
            $(".amenities-content").css("height", "265px");
        }
        $("#notes-more").click(function(){
         $("#notes-less").css("display", "block");
         $("#notes-more").css("display", "none");
         $(".notes-content").css("height", "100%");
      });
     
      $("#notes-less").click(function(){
         $("#notes-less").css("display", "none");
         $("#notes-more").css("display", "block");
         $(".notes-content").css("height", "265px");
      });
      if($(".notes-content").height() <= 265) {
             $("#notes-more").css("display", "none");
        }
         else {
            $("#notes-more").css("display", "block");
            $(".notes-content").css("height", "265px");
        }
   });
</script>
@stop