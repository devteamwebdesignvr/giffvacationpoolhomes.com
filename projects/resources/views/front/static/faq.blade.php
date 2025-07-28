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

	<!-- start about section -->
     
   <section class="about-sec">
       <div class="container">
           <div class="row">
              <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    @php $c1=1;@endphp
                @foreach(App\Models\Faq::orderBy("id","desc")->get() as $c)
                @if($c1==1)
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne{{$c->id}}">
                      <button class="ui-accordion__link accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$c->id}}" aria-expanded="true" aria-controls="collapseOne{{$c->id}}">
                          <span class="ui-accordion__number">{{$c1<=9?'0'.$c1:$c1}}</span> {{$c->question}}
                      </button>
                    </h2>
                    <div id="collapseOne{{$c->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{$c->id}}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                         {!! $c->answer !!}
                      </div>
                    </div>
                  </div>
                @else
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo{{$c->id}}">
                      <button class="ui-accordion__link  accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{$c->id}}" aria-expanded="false" aria-controls="collapseTwo{{$c->id}}">
                        <span class="ui-accordion__number">{{$c1<=9?'0'.$c1:$c1}}</span>  {{$c->question}}
                      </button>
                    </h2>
                    <div id="collapseTwo{{$c->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo{{$c->id}}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        {!! $c->answer !!}
                      </div>
                    </div>
                  </div>
                  @endif
                  @php $c1++;@endphp
                  @endforeach
                </div>
              </div>
           </div>
       </div>
   </section>

@stop