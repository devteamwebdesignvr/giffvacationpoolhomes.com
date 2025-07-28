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


    <section class="Map-sec">

        <div class="container">

            <div class="row">


              <div class="col-lg-9 col-md-9 col-12">
                <div class="line"></div>
                <h1>Map</h1>
                   <div class="map">
                    @foreach(App\Models\Property::orderBy("id","desc")->get() as $c)
                       <iframe src="{!! $c->map !!}" width="100%" height="550" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade" class="creek map-view-gaurav" id="map-{{ $c->id }}"></iframe>
                    @endforeach
                      
                   </div>

                </div>

                  <div class="col-lg-3 col-md-3 col-12">
                    <div class="address">
                        @foreach(App\Models\Property::orderBy("id","desc")->get() as $c)
                        <div class="loc-img" data-id="#map-{{ $c->id }}">
                            <img src="{{asset($c->feature_image)}}" alt="{{$c->name}}" class="img=fluid">
                            <p class="location" ><i class="fa-solid fa-home"></i> {{$c->name}}</p>
                        </div>
                        @endforeach
                    </div>
                

                </div>

                

            </div>

        </div>

    </section>

    


@stop

@section("js")
<script>
$(document).on("click",".loc-img",function(){
    $(".map-view-gaurav").hide();
    $($(this).data("id")).show();
})
</script>

@stop