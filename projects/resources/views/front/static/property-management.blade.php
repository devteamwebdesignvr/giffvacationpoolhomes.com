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
    <style>
        .left-sec_appr {
            width: 100%;
        }
        .sub-footer{
            display:none;
        }
    </style>
@stop


@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
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

    <!-- start about section -->
        
      <!-- About Section -->
      <section class="about_wrapper management">
         <div class="container">
            <div class="row m-0">

                    {!! $data->mediumDescription !!}
                    {!! $data->longDescription !!}

              
            </div>
         </div>
      </section>
      
      <section class="about_wrapper pro-mg">
         <div class="container">
    <div class="row">
                <div class="col-md-6">
                    <div class="inner-container" data-aos="fade-up" data-aos-duration="1500">
                        <div class="sec-title">
                            <h3 data-aos="fade-left" data-aos-duration="1500">Feel free to contact us</h3>
                            <div class="line">  </div>
                        </div>
                        <div class="contact-form">
                            {!! Form::open(["route"=>"contactPost"])  !!}
                                <div class="row clearfix">
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label>Full Name *</label>
                                        <input type="text" name="name" id="form_fname" placeholder="Full name" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-sm-12">
                                        <label>Email *</label>
                                        <input type="email" name="email" id="form_email" placeholder="Email *" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Phone *</label>
                                        <input type="number" name="mobile" id="form_phone" placeholder="Phone" value="" required="">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Message *</label>
                                        <textarea class="" name="message" id="msg" placeholder="Message" required=""></textarea>
                                    </div>  
                                     @if($setting_data['g_captcha_enabled'])
                                        @if($setting_data['g_captcha_enabled']=="yes")
                                            @if($setting_data['google_captcha_site_key']!="" && $setting_data['google_captcha_secret_key']!="")
                                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <div class="g-recaptcha" data-sitekey="{{ $setting_data['google_captcha_site_key'] }}"></div>
                                             </div>  
                                             @endif
                                        @endif
                                     @endif
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" name="submit" class="main-btn"><span class="content-wrapper">
                                    <span class="icon">
                                    <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="button-text">Send Message</span>
                                    </span></button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inner-column" data-aos="zoom-in-left" data-aos-duration="1500">
                        <div class="image ">
                            <img src="{{asset($data->image)}}" class="attachment-full size-full " alt="aboutus">
                        </div>
                    </div>
                </div>
            </div>
</div>
      </section>
@stop