@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("css")
<link href="{{asset('front/royalslider.css')}}" rel="stylesheet">
 <link href="{{asset('front/rs-defaulte166.css')}}" rel="stylesheet">
@stop

@section("container")
@php
$name=$data->name;
$bannerImage=asset('front/images/internal-banner.webp');;
if($data->banner_image){
$bannerImage=asset($data->banner_image);
}
@endphp
      
 
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
<a href="#book" class="sticky main-btn book1">
BOOK NOW
</a>
 <section id="property" class="padding_top padding_bottom_half">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 listing1 property-details">
              

               <div class="upper-box">
                   <div class="row">
                       <div class="col-lg-9 col-md-10 col-8 col-sm-8">
                           <div class="rating" data-aos="fade-up" data-aos-duration="1500">
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               {{ App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->count() }}+ Review
                           </div>
                           <h3 data-aos="fade-right" data-aos-duration="1500">{{$data->name}}</h3> 
                            <div class="hotel-info" data-aos="fade-up" data-aos-duration="1500"><i class="fas fa-map-marker-alt"></i>{{$data->address}}</div>
                       </div>
                       <div class="col-lg-3 col-md-2 col-4 col-sm-4">
                            <div class="price">
                                {!! $setting_data['payment_currency'] !!}{{$data->price}} <span>/ Day</span>
                            </div>
                       </div>
                   </div>
                    <ul class="food-list" data-aos="fade-up" data-aos-duration="1500" style="display:none;">
                       <li><i class="fa fa-bed" aria-hidden="true"></i>  {{$data->bedroom}} Bedrooms</li>
                       <li><i class="fa fa-bathtub" aria-hidden="true"></i>  {{$data->bathroom}} Bathrooms</li>
                       <li><i class="fa fa-users" aria-hidden="true"></i>  {{$data->sleeps}} Sleeps </li>
                   </ul>
               </div>

                  <section class="blog-details-area ptb-90">
                     <div class="container-fluid" style="" id="calender_nrj">
                        <div class="row">
                           <div class="col-md-12 col-xs-12 col-lg-12  col-sm-12 main-content"style="padding-right: 0px;padding-left: 0px;">
                              <div  class="page wrapper main-wrapper">
                                 <div class="row clearfix">
                                    <div class="col span_6 fwImage"style="text-align: center;">
                                       <div id="gallery-1" class="royalSlider rsDefault">

                                         
                                         @foreach(App\Models\PropertyGallery::where("property_id",$data->id)->orderBy("sorting","asc")->get() as $c)
                                          <a class="rsImg"   data-rsBigImg="{{asset($c->image)}}" href="{{asset($c->image)}}">
                                          <img width="126" height="82" class="rsTmb" src="{{asset($c->image)}}" alt="{{$c->caption}}"/>
                                          <span>{{$c->caption}}</span>
                                         
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
                  <!-- Slider js -->
                 
                  <div class="property_meta">
                     <div class="propert-box-sec">
                        <div class="tab-content">
                           <h3 class="heading-2">Overview</h3>
                        </div>
                        <hr class="hr">
                     </div>
                     <div class="overview-content">
                        {!! $data->long_description !!}
                     </div>
                     <div class="cta-btn" id="more">
                        <a class="main-btn mt-4">Read More</a>
                    </div>
                    <div class="cta-btn" id="less">
                        <a class="main-btn mt-4">Read Less</a>
                    </div>
                  </div>
                  <div id="amenities" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-30">
                        <div class="tab-content">
                           <h3 class="heading-2">Amenities</h3>
                        </div>
                        <hr class="hr">
                        @foreach(App\Models\PropertyAmenityGroup::where("property_id",$data->id)->orderBy("sorting","asc")->get() as $c)
                        <h4 style="font-size: 1.4rem;">{{$c->name}}</h4>
                        <div class="row">
                            @foreach(App\Models\PropertyAmenity::where("property_amenity_id",$c->id)->where("status","true")->orderBy("sorting","asc")->get() as $c1)
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <ul class="amenities">
                                 <li><i class="fa fa-check"></i> {{ $c1->name}}</li>
                              </ul>
                           </div>
                           @endforeach
                          
                        </div>
                        <hr class="hr">

                        @endforeach
                     </div>
                  </div>
                  <div id="rates" class="abouttext" style="margin-top: 30px;">
                    
                  
                     <div id="policies" class="abouttext" style="margin-top: 30px;">
                        <div class="tab-content">
                           <h3 class="heading-2">Policies</h3>
                           <hr class="hr">
                        </div>
                        
                     </div>
                     <br>
                     @if($data->cancellation_policy)
                     <h4>Cancellation Policy</h4>
                     {!! $data->cancellation_policy !!}
                     @endif
                     @if($data->short_description)
                     <h4>Damage and Incidentals</h4>
                     {!! $data->short_description !!}
                     @endif
                     @if($data->booking_policy)
                     <h4>Booking Policy</h4>
                     {!! $data->booking_policy !!}
                     @endif
                     @if($data->notes)
                     <h4>Notes</h4>
                     {!! $data->notes !!}
                     @endif
                     <p></p>
                  </div>
            
                   
                  <div id="reviews" class="abouttext" style="margin-top: 30px;">
                     <div class="inside-properties mb-50">
                        <div class="tab-content">
                           <h3 class="heading-2">Review</h3>
                        </div>
                        <hr class="hr">
                        <div class="comments">
                           <div class="comment">
                            @foreach(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("stay_date","desc")->get() as $c)
                              <div class="comment-content">
                                 <div class="comment-meta">
                                    <!-- <h3 style="margin-bottom: 18px;">Wonderful house and pool</h3> -->
                                    <span style="font-size: 14px;">5/5</span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                 </div>
                                 <div class="comment-meta" style="margin-top: 18px;">
                                    <h3 style="">{{$c->name}}</h3>
                                 </div>
                                 <p style="font-size: 14px;line-height: 20px;margin-top: 18px;"></p>
                                 <p>{{$c->message}}</p>
                                 <p></p>
                                 <span style="font-size: 14px;font-weight: 500;">Stayed {{date('F Y',strtotime($c->stay_date))}}</span>
                              </div>
                              <hr class="hr">
                            @endforeach



                                <section class="contact-page-section lv">
                     <div class="auto-container">
                        <!-- Sec Title -->
                        <div class="sec-title">
                           <h3 class="heading-2">Leave a Review</h3>
                        </div>
                        <div class="inner-container">
                           <!-- Contact Form -->
                           <div class="contact-form">
                               {!! Form::open(["autocomplete"=>"off","route"=>"reviewSubmit"]) !!}
                                 <div class="">
                                    <div class="row clearfix">
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-6 col-md-6">
                                          <label>
                                             Name *
                                          </label>
                                          <input type="text" name="name" placeholder="Name" required="">
                                       </div>
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                          <label>Email *</label>
                                          <input type="email" name="email" placeholder="Email" required="">
                                       </div>
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                          <label>Captions  *</label>
                                          <input type="text" name="profile" required placeholder="Captions">
                                       </div>
                                       <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                          <label>Stay Date</label>
                                          <input type="date"  class="datepicker123" name="stay_date" placeholder="Stay date" >
                                          <input type="hidden" name="property_id" value="{{ $data->id }}">
                                       </div>
                                       <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                          <label>Rating  *</label>
                                          <fieldset class="score">
                                             <input type="radio" id="score-5" name="score" value="5" checked>
                                             <label title="5 stars" for="score-5" style="font-size: 25px;">5 stars</label>
                                             <input type="radio" id="score-4" name="score" value="4">
                                             <label title="4 stars" for="score-4" style="font-size: 25px;">4 stars</label>
                                             <input type="radio" id="score-3" name="score" value="3">
                                             <label title="3 stars" for="score-3" style="font-size: 25px;">3 stars</label>
                                             <input type="radio" id="score-2" name="score" value="2">
                                             <label title="2 stars" for="score-2" style="font-size: 25px;">2 stars</label>
                                             <input type="radio" id="score-1" name="score" value="1">
                                             <label title="1 stars" for="score-1" style="font-size: 25px;">1 stars</label>
                                          </fieldset>
                                       </div>
                                       <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                          <label>Review *</label>
                                          <textarea class="" name="message" required placeholder="Review"></textarea>
                                       </div>
                                       <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                          <button type="submit" class="main-btn" name="reviewsubmit"><span class="txt">
                                              <span class="content-wrapper">
                <span class="icon">
                <i class="fa-solid fa-arrow-right"></i></span>
                <span class="button-text">Submit Review</span>
                </span></span></button>
                              
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </section>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
    <div class="col-lg-4" id="book">
       <div class="get-quote car-quote">
            @if($data->website)
               <a href="{{ $data->website }}" target="_BLANK">Book Now</a>
            @endif
        </div>
     </div>




           
            </div>
         </div>
      </section>
@if($data->map)
<div class="map" id="#map">
    <iframe src="{!! $data->map !!}" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endif
@stop

@section("js")  
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-days-area">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Additional Fee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-service-area">
        Modal body..
      </div>

      <!-- Modal footer -->
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
        ajaxCallingData();
    }
</script>
<script>
  $('.more').readmore({
    speed: 75, //Açılma Hızı
    collapsedHeight:312, // 100px sonra yazının kesileceğini belirtir.
    moreLink: '<a class="ac" href="#">Show more</a>', // açma linki yazısı
    lessLink: '<a class="kapat" href="#">Show Less</a>', // kapatma linki yazısı
  });
</script>

<script src="{{ asset('front/js/showmore.js')}}"></script>

<script>
$(function(){
    $(".datepicker").datepicker();
});
</script>

@php
$new_data_blocked=LiveCart::iCalDataCheckInCheckOut($data->id);
    $checkin=$new_data_blocked['checkin'];
    
    $checkout=$new_data_blocked['checkout'];

@endphp
<script type="text/javascript">
    var checkin = <?php echo json_encode($checkin);  ?>;
    var checkout = <?php echo json_encode($checkout);  ?>;
    $(function() {
        $("#txtFrom").datepicker({
            numberOfMonths: 1,
            minDate: '@minDate',
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
            beforeShowDay: function(date) {

                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

                return [checkout.indexOf(string) == -1]

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
                       
    @php
       if(Request::get("start_date")){
        if(Request::get("end_date")){
        
    @endphp
    $(document).ready(function(){
        ajaxCallingData();
    });
        
    @php
        }
       }
    @endphp
    
    $(document).on("change","#pet_fee_data_guarav",function(){
        ajaxCallingData();
    });
    
    function ajaxCallingData(){
        pet_fee_data_guarav=$("#pet_fee_data_guarav").val()
        adults=$("#adults-data").val();
        childs=$("#child-data").val();
         if($("#txtFrom").val()!=""){
             if($("#txtTo").val()!=""){
                 $.post("{{route('checkajax-get-quote')}}",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),pet_fee_data_guarav:pet_fee_data_guarav,adults:adults,childs:childs,book_sub:true,property_id:{{ $data->id }}},function(data){
                    if(data.status==400){
                        $("#submit-button-gaurav-data").hide();
                        toastr.error(data.message);
                    }else{
                        $("#submit-button-gaurav-data").show();
                        $("#gaurav-new-modal-days-area").html(data.modal_day_view);
                        $("#gaurav-new-modal-service-area").html(data.modal_service_view);
                        $("#gaurav-new-data-area").html(data.data_view);
                    }
                });
             }
         }                     
        
    }
    
</script>
 <script>
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
         
         });
         
      </script>
      
      <script>
      $(document).ready(function(){
  $("#more").click(function(){
    $("#less").css("display", "block");
    $("#more").css("display", "none");
    $(".overview-content").css("height", "100%");
  });
  
  $("#less").click(function(){
    $("#less").css("display", "none");
    $("#more").css("display", "block");
    $(".overview-content").css("height", "230px");
  });
});
      </script>
@stop