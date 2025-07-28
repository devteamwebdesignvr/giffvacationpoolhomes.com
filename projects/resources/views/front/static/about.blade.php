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
        $bannerImage=asset('front/images/b1.jpg');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
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
    <section class="agency-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3>{{ $data->shortDescription }}</h3>
                    {!! $data->longDescription !!}
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                   <div class="inner-column" data-aos="zoom-in-left" data-aos-duration="1500">
                        <div class="image ">
                            <img src="{{asset($data->image)}}" class="attachment-full size-full " alt="aboutus" sizes="(max-width: 1024px) 100vw, 1024px" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop