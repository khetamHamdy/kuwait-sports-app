@extends("layouts.siteLayout")
@section('title')
    {{__('Products')}}
@endsection
@section('css')
@endsection
@section("content")
    <br> <br> <br> <br>
    <!--section_home-->
    <section class="section_location">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>{{__('Products')}}</h2>
            </div>
            <div class="row">
                @foreach($products as $one)
                    <div class="col-lg-4">
                        <div class="item-location wow fadeInUp">
                            <figure><img width="370px" height="237px" src="{{asset($one->image)}}"
                                         alt="Image Location"/></figure>
                            <div class="txt-location">
                                <h4>{!! $one->title !!}
                                </h4>
                                <p>{!! Str::limit(strip_tags($one->description ) ,  250)!!}</p>
                                <a href="{{route('detail.product' , $one)}}"
                                   class="btn-site"><span>{{__('Read More')}}</span></a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
    <!--section_gallery_event-->

    <section class="section_data_event">
        <div class="container">
            <div class="our-logo">
                <h4>{{__('Our Logo')}}</h4>
                <p>{{$setting->text_ourLogo}}</p>
                <div class="lst-logo">
                    <div class="item-logo">
                        <p>{{__('Primary Logo')}}</p>
                        <div class="download0--logo">
                            <figure><img src="{{asset($setting->primaryLogo)}}" alt=""/></figure>
                            <a href="{{asset($setting->primaryLogo)}}"><i
                                    class="fa-solid fa-cloud-arrow-down"></i> {{__('Download')}}</a>
                        </div>
                    </div>
                    <div class="item-logo">
                        <p>{{__('Secondary Logo')}}</p>
                        <div class="download0--logo">
                            <figure><img src="{{asset($setting->secondaryLogo)}}" alt=""/></figure>
                            <a href="{{asset($setting->secondaryLogo)}}"><i
                                    class="fa-solid fa-cloud-arrow-down"></i> {{__('Download')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-media">
                <h4>{{__('Social Media')}}</h4>
                <p>{{$setting->text_socialMedia}}</p>
                <ul>
                    <li><a href="{{ $setting->youTube }}"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="{{ $setting->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="{{ $setting->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
@endsection
