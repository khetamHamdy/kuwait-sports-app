@extends("layouts.siteLayout")
@section('title')
    {{__('Events')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_event" style="background: url({{asset($setting->image_web_all)}})">
        <div class="container">
            <div class="home_txt">
                <h1 class="wow fadeInUp">{{__('Events')}}</h1>
                <p class="wow fadeInUp">{!! $event_first !!}</p>
            </div>
        </div>
    </section>
    <!--section_home-->

    <section class="section_location">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>{{__('Events')}}</h2>
            </div>
            <div class="row">
                @foreach($event as $one)
                    <div class="col-lg-4">
                        <div class="item-location wow fadeInUp">
                            <figure><img width="370px" height="237px" src="{{asset($one->image)}}"
                                         alt="Image Location"/></figure>
                            <div class="txt-location">
                                <h4>{!! $one->title !!}
                                </h4>
                                <p>{!! Str::limit(strip_tags($one->description ) ,  250)!!}</p>
                                <a href="{{route('details.event' , $one)}}"
                                   class="btn-site"><span>{{__('Read More')}}</span></a>
                            </div>
                            <div class="fav-location">
                                <a href=""><i class="
                                  @if($one->is_favourite==1) fa-solid @else fa-regular  @endif
                                fa-heart favorite_users" data-id="{{$one->id}}"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--section_gallery_event-->

@endsection
