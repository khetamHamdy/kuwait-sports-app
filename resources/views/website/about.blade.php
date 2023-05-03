@extends("layouts.siteLayout")
@section('title')
{{__('About Us')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_event" style="background: url({{asset($setting->image_web_all)}})">
        <div class="container">
            <div class="home_txt">
                <h1 class="wow fadeInUp">{{__('About Us')}}</h1>
                <p class="wow fadeInUp">{{$setting->about_description1}}</p>
            </div>
        </div>
    </section>
    <!--section_home-->
    <section class="section_provide">
        <div class="container">
            <div class="sec_head flex-column">
                <h2>{{__('We Provide you')}}</h2>
                <p>{{$setting->provide_description1}}</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="item-provide">
                        <figure><img src="{{asset($setting->service_image1)}}" alt=""/></figure>
                        <div class="txt-provide">
                            <h5>{{$setting->service_title1}}</h5>
                            <p>{{$setting->service_description1}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item-provide">
                        <figure><img src="{{asset($setting->service_image2)}}" alt=""/></figure>
                        <div class="txt-provide">
                            <h5>{{$setting->service_title2}}</h5>
                            <p>{{$setting->service_description2}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item-provide">
                        <figure><img src="{{asset($setting->service_image3)}}" alt=""/></figure>
                        <div class="txt-provide">
                            <h5>{{$setting->service_title3}}</h5>
                            <p>{{$setting->service_description3}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont-stat">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="item-stat">
                            <h2>{{$setting->count_total_client}}</h2>
                            <p>{{__('TOTAL CLIENTS')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="item-stat">
                            <h2>{{$setting->count_project_complete}}</h2>
                            <p>{{__('PROJECT COMPLETE')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="item-stat">
                            <h2>{{$setting->count_active_employee}}</h2>
                            <p>{{__('ACTIVE EMPLOYEE')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="item-stat">
                            <h2>{{$setting->count_avg_rating}}</h2>
                            <p>{{__('AVG. RATING')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_gallery_event-->
@endsection
