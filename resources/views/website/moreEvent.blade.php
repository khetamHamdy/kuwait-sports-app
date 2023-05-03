@extends("layouts.siteLayout")
@section('title')
{{__('Read More')}}
@endsection
@section('css')
@endsection
@section("content")
    <br> <br> <br> <br>
    <section class="section_featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

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
                                         fa-heart"></i></a>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="content-advertisment wow fadeInUp">
                        <div class="head-advertisment">
                            <h5>{{__('Advertisment')}}</h5>
                        </div>
                        <div class="bd-advertisment">
                            <img src="{{asset('uploads/image/'.$poster->image)}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_featured-->

@endsection
