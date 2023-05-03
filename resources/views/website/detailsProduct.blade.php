@extends("layouts.siteLayout")
@section('title')
    {{__('details Product')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="head-page">
                <h4>{!!$product->title!!}</h4>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="content-details">
                        <p>
                            {!! $product->description !!}
                        </p>
                        @if($product->image)
                            <figure><img src="{{asset($product->image)}}" alt=""/></figure>
                        @endif
                        <p>{!! $product->description !!}</p>

                        @if($product->productImages)
                            <div class="cont-interview">
                                <div class="row">
                                    @foreach($product->productImages as $one)
                                        <div class="col-lg-6">
                                            <div class="item-interview wow fadeInUp">
                                                <figure><img src="{{asset($one->image)}}" alt=""/></figure>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
