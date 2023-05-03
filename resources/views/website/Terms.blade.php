@extends("layouts.siteLayout")
@section('title')
    Terms of Use
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_event" style="background: url({{$setting->image_web_all}})">
        <div class="container">
            <div class="home_txt">
                <h1>{{__('Terms Condition')}}</h1>
                <p>
                    {!! $setting->terms_condition !!}
                </p>
            </div>
        </div>
    </section>
@endsection
