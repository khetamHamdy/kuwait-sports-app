<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <!-- Stylesheets -->
    <link rel="icon" href="{{asset($setting->fav_icon)}}">
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <!-- Responsive -->
    <link href="{{asset('front/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js')}}"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="{{asset('front/js/respond.js')}}"></script><![endif]-->
    <script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


</head>

<body>
@include('sweetalert::alert')
<div class="main-wrapper">

    <header id="header" class="header-home">
        <div class="container">
            <div class="logo-site">
                <a href="{{route('home')}}">
                    <img class="logo-web" src="{{asset('front/images/logo.svg')}}" alt=""/>
                </a>
            </div>
            <ul class="main_menu clearfix">
                <li @if(Route::currentRouteName() == 'home') class="active" @endif><a class="page-scroll"
                                                                                      href="{{route('home')}}">{{__('Places')}}</a>
                </li>
                <li @if(Route::currentRouteName() == 'products') class="active" @endif><a class="page-scroll"
                                                                                          @if(Route::currentRouteName() == 'home')
                                                                                              href="{{route('home')}}#Product"
                                                                                          @else
                                                                                              href="{{route( 'products')}}"
                        @endif>
                        {{__('Products')}}</a></li>

                <li @if(Route::currentRouteName() == 'Interviews') class="active" @endif>
                    <a class="page-scroll"
                       @if(Route::currentRouteName() == 'home')
                           href="{{route('home')}}#interview"
                       @else
                           href="{{route( 'Interviews')}}"
                        @endif>{{__('Interviews')}}</a>
                </li>

                <li @if(Route::currentRouteName() == 'advice') class="active" @endif>
                    <a class="page-scroll"

                       @if(Route::currentRouteName() == 'home')
                           href="{{route('home')}}#advice"
                       @else
                           href="{{route('advice')}}"
                        @endif
                    >{{__('Advice')}} </a>
                </li>

                <li @if(Route::currentRouteName() == 'event') class="active" @endif><a class="page-scroll"
                                                                                       href="{{route('event')}}">{{__('Events')}}</a>
                </li>

                <li @if(Route::currentRouteName() == 'photo-contest-user') class="active" @endif><a class="page-scroll"
                                                                                                    href="{{route('photo-contest-user')}}">{{__('Photo Contest')}}</a>
                </li>

                <li @if(Route::currentRouteName() == 'photo-media') class="active" @endif><a class="page-scroll"
                                                                                               href="{{route('photo-media')}}">{{__('Media')}}</a>
                </li>

                <li @if(Route::currentRouteName() == 'about') class="active" @endif><a class="page-scroll"
                                                                                       href="{{route('about')}}">{{__('About Us')}}</a>
                </li>
                <li>

                    @if(app()->getLocale()=='ar')
                        <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English </a>
                    @elseif(app()->getLocale()=='en')
                        <a class="page-scroll" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">عربي</a>
                    @endif

                </li>
                @guest('web')
                    <li class="sign-menu sign-site"><a class="page-scroll"
                                                       href="{{route('login')}}">{{__('Sign In/ Register')}}</a></li>
                @endguest
            </ul>
            @guest('web')
                <div class="sign-site"><a href="{{route('login')}}" class="page-scroll">{{__('Sign In/ Register')}}</a>
                </div>
            @endguest
            @auth('web')
                <div class="d-account dropdown">
                    <a class="page-scroll dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{asset(\Illuminate\Support\Facades\Auth::guard('web')->user()->image)}}" alt=""/>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('edit.profile') }}">{{__('Edit Profile')}}</a></li>
                        <li><a class="dropdown-item" href="{{ route('edit.password') }}">{{__('Change Password')}}</a>
                        </li>
                        <li><a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                                                    document.getElementById('log').submit();">
                                {{__('Sign Out')}}</a></li>
                    </ul>
                    <form id="log" style="display:none" action="{{ route('logout') }}"
                          method="post">
                        @csrf
                    </form>
                </div>
            @endauth

            <div class="opt-mobail">
                <button type="button" class="hamburger hum-menu">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>

            </div>
        </div>
        <div class="menu-oth">
            <button type="button" class="hamburger hum-mega">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="mega-menu">
                <div class="container">
                    <form class="form-search" method="get" action="{{route('search')}}">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="{{__('Search')}}"/>
                            <button class="btn-search">{{__('Go')}}</button>
                        </div>
                    </form>
                    <div class="row" id="Reviews">
                        <div class="col-lg-3">
                            <div class="cont-mega">
                                <h5>{{__('Reviews')}}</h5>
                                <ul>
                                    @foreach($event_title as $one)
                                        <li><a href="{{route('details.event' , $one)}}">{{$one->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="cont-mega">
                                <h5>{{__('Advice')}}</h5>
                                <ul>
                                    @foreach($event_advice as $one)
                                        <li><a href="{{route('details.event' , $one)}}">{{$one->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="cont-mega">
                                <h5>{{__('Routes')}}</h5>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="cont-mega">
                                <h5>{{__('Newsletter')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header-->
    @yield("content")

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="cont-ft wow fadeInUp">
                        <figure class="logo-ft wow fadeInUp">
                            <img src="{{asset($setting->secondaryLogo)}}" alt="Logo" class="img-fluid">
                        </figure>
                        <p>{{$setting->text_footer}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="menu-ft">
                        <h5>{{__('Connect & Share')}}</h5>
                        <div class="cont-social">
                            <p>{{__('Follow Us')}}</p>
                            <ul class="list-contact wow fadeInUp">
                                <li><a href="{{ $setting->youTube }}"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="{{ $setting->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="{{ $setting->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="menu-ft">
                        <h5>{{__('Helpful Links')}} </h5>
                        <ul class="li-ft wow fadeInUp">
                            <li><a href="about.html">{{__('Subscribe')}}</a></li>
                            <li><a href="{{route('privacy.policy')}}">{{__('Privacy Policy')}}</a></li>
                            <li><a href="{{route('terms.condition')}}">{{__('Terms of Use')}}</a></li>
                            <li><a href="{{route('about')}}">{{__('About Us')}}</a></li>
                            <li><a href="{{route('food')}}">{{__('Food items')}}</a></li>
                            <li><a href="{{route('contact.create')}}">{{__('Contact')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer-->

</div>
<!--main-wrapper-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/all.min.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/wow.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="{{asset('front/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('front/js/script.js')}}"></script>
<script>
    new WOW().init();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('js')
<script>
    $(document).on('click', '.favorite_users', function (e) {
        e.preventDefault();
        var event_id = $(this).data('id');
        var vm = $(this);

        $.ajax({
            type: 'get',
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            url: "{{url('event_favorite/')}}/" + event_id + "/" + {{\Illuminate\Support\Facades\Auth::guard('web')->id() ?? 5}},
            success: function (response) {
                if (response.bool == true) {
                    vm.removeClass('fa-regular').addClass('fa-solid');
                }
                if (response.bool == false) {
                    vm.removeClass('fa-solid').addClass('fa-regular');
                }
            },
            error: function (jqXHR, error, errorThrown) {
                swal.fire("Please make a login to be able to work like", event_id, "info");
            }
        });

    });
</script>
</body>

</html>
