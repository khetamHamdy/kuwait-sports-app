@extends("layouts.siteLayout")
@section('title')
    Events
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="head-page">
                <h4>{{__('Food items')}}</h4>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="cont-food">
                        <div class="row">
                            @foreach($food as $one)
                                <div class="col-lg-6">
                                    <div class="item-food">
                                        <figure><img src="{{asset($one->image)}}" alt=""/></figure>
                                        <div class="txt-food">
                                            <a href="{{route('details.event' , $one)}}"
                                               class="btn-site"><span>{{$one->title}}</span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
        </div>
    </section>
    <!--section_home-->
@endsection
