@extends("layouts.siteLayout")
@section('title')
    {{__('Interviews')}}
@endsection
@section('css')
@endsection
@section("content")
    <br> <br> <br> <br>
    <section class="section_featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="text-capitalize text-white text-blue-50 mr-5">{{__('Interviews')}}</h2>
                    <br>
                    <div class="list-featured">
                        @foreach($event as $one)

                            <div class="item-featured wow fadeInUp">
                                <figure><img src="{{asset($one->image)}}" alt="Image Featured"/></figure>
                                <div class="txt-featured">
                                    <h4>{!!$one->title!!}</h4>
                                    <p>{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
                                    <a href="{{route('details.event' , $one)}}"
                                       class="btn-site"><span>{{__('Read More')}}</span></a>
                                </div>
                                <div class="fav-featured">
                                    <a href=""><i class="
                                           @if($one->is_favourite==1) fa-solid @else fa-regular  @endif
                                    fa-heart favorite_users" data-id="{{$one->id}}"></i></a>
                                </div>
                            </div>

                        @endforeach
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
    <!--section_featured-->

@endsection
