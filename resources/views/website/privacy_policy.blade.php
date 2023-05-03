@extends("layouts.siteLayout")
@section('title')
    Privacy Policy
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_event" style="background: url({{$setting->image_web_all}})">
        <div class="container">
            <div class="home_txt">
                <h1>{{__('Privacy Policy')}}</h1>
                <p>
                    {!! $setting->privacyPolicy_text !!}
                </p>
            </div>
        </div>
    </section>


@endsection
