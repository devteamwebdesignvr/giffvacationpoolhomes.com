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
@section("container")
    @php
        $name=$data->title;
        $bannerImage='https://ga4prozbj7-flywheel.netdna-ssl.com/wp-content/themes/aspenhomes/dist/images/trees-bg-600x350.jpg';
        if($data->image){
            $bannerImage=asset($data->image);
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





    <section class="Blog-details">

        <div class="container">
            <div class="blog-info">
           <h2>{{$data->title}}</h2>

           <img src="{{ asset($data->featureImage)}}" class="img-fluid" alt="" />
              <div class="feat_blog_con">

                        <p>

                            <span><i class="fas fa-calendar-alt" aria-hidden="true"></i> {{ date('d M Y',strtotime($data->created_at)) }}</span>



                            &nbsp;&nbsp;

                            @php $category=App\Models\Blogs\BlogCategory::where("id",$data->blog_category_id)->first(); @endphp

                            @if($category)

                            <span><i class="fas fa-globe" aria-hidden="true"></i><a href="{{ url('blogs/category/'.$category->seo_url) }}/"> {{$category->title}}</a></span>

                            @endif

                        </p>

                      </div>
            {!! $data->longDescription !!}
            </div>
        </div>

    </section>


@stop