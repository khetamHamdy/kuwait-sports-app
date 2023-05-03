@extends("layouts.siteLayout")
@section('title')
{{__('details')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="head-page">
                <h4>{!!$event->title!!}</h4>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="content-details">
                        <p>
                            {!! $event->description !!}
                        </p>
                        <figure><img src="{{ asset($event->image) }}" alt="" /></figure>
                        <p>{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
{{--                        <div class="cont-interview">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($event->eventImages as $one)--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="item-interview wow fadeInUp">--}}
{{--                                        <figure><img src="{{asset($one->image)}}" alt="" /></figure>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
                      </div>
                </div>
                <div class="col-lg-3">
                    <div class="cont-aside">
                        @if($poster820)
                            <img src="{{asset('uploads/image/'.$poster820->image)}}">
                        @endif
                    </div>
                    <div class="cont-aside-smaller">
                        @if($poster450)
                            <img src="{{asset('uploads/image/'.$poster450->image)}}">
                        @endif
                    </div>
                </div>
            </div>

            <div class="content-tb">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos"
                                type="button" role="tab" aria-controls="photos" aria-selected="true">{{__('Show Photos')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos"
                                type="button" role="tab" aria-controls="videos" aria-selected="false">{{__('videos')}}
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    {{--                    //videos--}}
                    <div class="tab-pane fade " id="videos" role="tabpanel" aria-labelledby="videos-tab">
                        <div class="row">
                                @if($event->video)
                                    <div class="col-lg-6">
                                        <div class="item-gallery">
                                            <a href="{{asset($event->video)}}" data-fancybox="gallery">
                                                <video src="{{asset($event->video)}}" width="500px" height="400px"></video>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <div class="row">
                            @foreach($event->eventImages as $one)
                                @if($one->image)
                                    <div class="col-lg-4">
                                        <div class="item-gallery">
                                            <a href="{{asset($one->image)}}" data-fancybox="gallery"><img src="{{asset($one->image)}}" width="500px" height="400px" alt=""/></a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>


        </div>
        </div>
    </section>
    <!--section_home-->
@endsection
