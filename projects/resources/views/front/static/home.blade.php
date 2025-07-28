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
<style> .readMore a{color:white;}</style>
<!-- Banner slider -->
<section class="banner-wrapper p-0">
    <div class="video-sec">
        <video src="{{ asset('front')}}/images/Sandy.mp4" loop="" muted="" autoplay="" playsinline="" class="js-hero-slide__inner" id="mob"></video>
        <button onclick="playVideo()" id="play"><i class="fa-solid fa-play"></i></button>
        <button onclick="pauseVideo()" id="pause"><i class="fa-solid fa-pause"></i></button>
        <div class="overlay">
            <div class="hero-content" data-aos="zoom-in" data-aos-duration="1500">
                <h1 class="h-big">
                    <span class="nst">Giff Vacation Pool Homes</span><br/> Near Disney World 
                </h1>
            </div>
        </div>
    </div>
    <div class="container booking-area">
        <form action="{{ url('properties') }}" method="get">
            <div class="row">
                <div class="col-lg md-3 icns mb-lg-0 position-relative">
                    {!! Form::text("start_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in","class"=>"form-control"]) !!}
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div class="col-lg md-3 icns mb-lg-0 position-relative">
                    {!! Form::text("end_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out","class"=>"form-control lst" ]) !!}
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
             
                <div class="col-lg md-3 mb-lg-0 loct icns position-relative">
                    <input type="text" name="Guests" readonly class="form-control gst" value="1 Guests" id="show-target-data" placeholder="Guests">
                    <input type="hidden" value="1" name="adults" id="adults-data" />
                    <input type="hidden" value="0" name="child" id="child-data" />
                    <div class="adult-popup">
                        <div class="modal-bodyss" id="guestsss">
                            <p class="close1" onclick=""><i class="fa fa-times"></i></p>
                            <div class="ac-box">
                                <div class="adult">
                                    <span id="adults-data-show">1 Adult</span>
                                    <p>(18+)</p>
                                </div>
                                <div class="btnssss">
                                    <div class="button button1 btnnn" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Increment Value">-</div>
                                    <div class="button11 button1" onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</div>
                                </div>
                            </div>
                            <div class="ac-box">
                                <div class="adult">
                                    <span id="child-data-show">Children</span>
                                    <p>(0-17)</p>
                                </div>
                                <div class="btnssss btnsss">
                                    <div class="button button1" onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Increment Value">-</div>
                                    <div class="button11 button1" onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</div>
                                </div>
                            </div>
                            <div class="ac-box"  style="display: none;">
                                <div class="adult">
                                    <span id="child-data-show">Pet</span>
                                </div>
                                <div class="btnsssss btnsss">
                                    <input type="radio" id="pet1" name="is_pet" value="Yes">
                                    <label for="pet1">Yes</label>
                                    <input type="radio" id="pet2" name="is_pet" checked value="No">
                                    <label for="pet2">No</label> 
                                </div>
                            </div>
                            <button type="button" class="btn main-btn close1" data-dismiss="modal" onclick="">Apply</button>
                        </div>
                    </div>
                    <i class="fa-solid fa-users "></i>
                </div>
                <div class="col-lg md-4 md-lg-0 srch-btn">
                    <button type="submit" class="main-btn ">Check Availability</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- banner slider end -->
<section id="about" class="about_wrapper">
    <div class="container">
        <div class="row flex-lg-row flex-column-reverse">
            <div class="col-lg-6 text-center text-lg-start">
                <div class="heading_sec">
                    <h3 class="heading">About Us</h3>
                </div>
                {!!  $data->mediumDescription !!}
                <a href="{{url('/about-us')}}" class="main-btn mt-4" role="button"> <span class="content-wrapper"> <span class="icon"><i class="fa-solid fa-arrow-right"></i></span><span class="button-text">Explore</span> </span></a>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-4 position-relative text-center">
                @if($data->image)
                <div class="about-img1">
                    <img src="{{ asset($data->image) }}" class="attachment-full size-full " alt="" >
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if(App\Models\Location::count()>0)
<section class="featured-pro" id="abt">
	<div class="container">
		<div class="head-sec">
			<h2>Locations We Host</h2>
		</div>
		<div class="row">
			@php $i=1;@endphp
			@foreach(App\Models\Location::orderBy("id","desc")->take(2)->get() as $c)
			<div class="col-lg-6 col-md-6 col-12 main-prop">
				<div class="prop-contt">
					<div class="pro-img">
						@if($c->image)
						    <img src="{!! asset($c->image) !!}" class="img-fluid" alt="{{$c->name}}">
						@endif
					</div>
					<div class="pro-cont">
						<h3 class="title">{{$c->name}}</h3>
					</div>
					<a href="{{ url('properties/location/'.$c->seo_url) }}"></a>
				</div>
			</div>
			@php $i++;@endphp
			@endforeach
		</div>
	</div>
</section>
@endif

@if(App\Models\HostFully\HostFullyProperty::where(["is_home"=>"true","isActive"=>"1","status"=>"true"])->count()>0)
<section class="property-sec">
    <div class="container">
        <h2>Check Out Our Properties</h2>
        <div class="row">
            @php $i=1; @endphp
            @foreach(App\Models\HostFully\HostFullyProperty::where(["is_home"=>"true","isActive"=>"1","status"=>"true"])->take(7)->orderBy("id","desc")->get() as $c)
                @php 
                  $images = [];
                  $i1=0;                 
                  $imageList = App\Models\HostFully\HostFullyPropertyPhoto::where("property_uid",$c->uid)->orderBy("displayOrder","asc")->get();                  
                  if(count($imageList)>0){
                   foreach($imageList as $img){
                     if($i1 == 0){
                       $images[] = $img;
                     }
                      $i1++;
                   } 
                  }
                 @endphp
                @php  if($i==1 || $i==4 || $i==5){ $class="col-4";}else{$class="col-8";} @endphp
                <div class="{{ $class }}">
                    <a href="{{url('properties/detail/'.$c->seo_url)}}">
                        <div class="image-sec">
                            <img src="{{$images[0]['url']}}" alt="{{ $images[0]['description'] }}" class="img-fluid" />
                        </div>
                        <div class="content-sec">
                            <div class="upper"><h3>{{$c->name}}</h3></div>
                            <div class="bottom">
                                <div class="amenity">
                                    @if($c->maxGuests)
                                        <div class="amn guest"> <i class="fa fa-users"></i>  <span>{{$c->maxGuests}}</span></div>
                                    @endif
                                    @if($c->bedrooms)
                                        <div class="amn bed"> <i class="fa fa-home"></i>  <span>{{ $c->bedrooms }}</span></div>
                                    @endif
                                    @if($c->bedrooms)
                                        <div class="amn bath"> <i class="fa fa-bath"></i> <span>{{ $c->bathrooms }}</span></div>
                                    @endif
                                    @if($c->beds)
                                        <div class="amn bed"><i class="fa fa-bed"></i> <span>{{ $c->beds }}</span></div>
                                    @endif
                                </div>
                                <div class="button-sec">
                                    <div class="main-btn" role="button">
                                        <span class="content-wrapper">
                                        <span class="icon">
                                        <i class="fa-solid fa-arrow-right"></i></span>
                                        <span class="button-text">View Details</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @php $i++; @endphp
            @endforeach
            <div class="col-4 last">
                <a href="{{url('/properties')}}">
                    <div class="image-sec">
                    </div>
                    <div class="content-sec">
                        <div class="upper">
                            <h3>See All Properties</h3>
                        </div>
                        <div class="bottom">
                            <div class="button-sec">
                                <div class="main-btn" role="button">
                                    <span class="content-wrapper">
                                    <span class="icon">
                                    <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="button-text">View More</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@php $list=App\Models\Attraction::orderBy("id","desc")->take(6)->get();@endphp 
@if(count($list)>0)
<section class="attraction-sec">
    <div class="container">
        <h2>Attractions To Explore</h2>
        <div class="row">
            @foreach($list as $c)
                <div class="col-4">
                    <a @if($c->type == "extremal") href="{{ url($c->extarnal_url) }}" @else href="{{ url('attractions/detail/'.$c->seo_url) }}" @endif>
                        <div class="image-sec">
                            <img src="{{ asset($c->image)}}" class="img-fluid" alt="">
                        </div>
                        <div class="content-sec">
                            <h3>{{$c->name}}</h3>
                        </div>
                    </a>
                </div>
            @endforeach 
        </div>
    </div>
</section>
@endif
@if(App\Models\Testimonial::where("status","true")->count()>0)
<section class="rev-sec1">
    <h2>See What Our Guests Are Saying</h2>
</section>
<section class="rev-sec">
    <div class="overlay">
        <div class="container">
            <div class="row slick-testimonial">
                @foreach(App\Models\Testimonial::where("status","true")->orderBy("stay_date","desc")->get() as $c)
                <div class="col-6 rev first ">
                    <div class="rev-area ">
                        <div class="heading-sec">
                            <img src="{{ asset($c->image)}}" class="img-fluid" alt="{{App\Models\Property::find($c->property_id)->name ?? ''}}">
                            <div class="cont">
                                <h4 class="owner">{{$c->name}}</h4>
                                <p class="pro-name d-none">
                                    {{App\Models\Property::find($c->property_id)->name ?? ''}}
                                </p>
                              <p class="pro-name">
                                    {{ date('F Y', strtotime($c->stay_date)) }}
                                </p>
                            </div>
                        </div>
                        <div class="rev-content">
                            <p>{{$c->message}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@stop
@section("js")
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
               maxDate:"{{ date('Y-m-d', strtotime('+2 year')) }}",
            dateFormat: 'yy-mm-dd', 
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkout.indexOf(string) == -1];
            },
            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#txtFrom").datepicker("option", "maxDate", dt);
            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });
</script>
@stop