@extends("layouts.siteLayout")
@section('title')
    {{__('Kuwait Outdoor Sports')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_home">
        <div class="owl-carousel" id="slide-home">
            @foreach($silder as $one)
                <div class="item" style="background: url({{asset($one->image)}})">
                    <div class="container">
                        <div class="home_txt">
                            <h1 class="wow fadeInUp">{!! $one->title !!}</h1>
                            <p class="wow fadeInUp">{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
                            <a href="{{$one->link}} " class="btn-read">{{__('Read More')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--section_home-->

    <section class="section_featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="sec_head wow fadeInUp">
                        <h2>{{__('Featured')}}</h2>
                    </div>
                    <div class="list-featured">
                        @foreach($event_featured as $one)
                            @php $count =0 @endphp
                            <div class="item-featured wow fadeInUp">
                                <figure><img width="190px" height="190px" src="{{asset($one->image)}}"
                                             alt="Image Featured"/></figure>
                                <div class="txt-featured">
                                    {{--                                    {{ $one->users->get($loop->index)->pivot->event_id ?? ''}}--}}
                                    <h4>{!!$one->title!!}</h4>
                                    <p style="color: black !important; ">{!!Str::limit(strip_tags($one->description ) ,  150)!!}</p>
                                    <a href="{{route('details.event' , $one)}}"
                                       class="btn-site"><span>{{__('Read More')}}</span></a>
                                </div>
                                <div class="fav-featured">
                                    <a href=""><i
                                            class="
                                      @if($one->is_favourite==1) fa-solid @else fa-regular  @endif
                                             fa-heart favorite_users"
                                            data-id="{{$one->id}}"></i></a>
                                </div>
                            </div>
                            @php $count++@endphp
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="content-advertisment wow fadeInUp">
                        <div class="head-advertisment">
                            <h5>{{__('Advertisment')}}</h5>
                        </div>
                        <div class="bd-advertismentadvertisment">
                            @if($poster820)
                            <img src="{{asset('uploads/image/'.$poster820->image ?? '') }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_featured-->

    <section class="section_location">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>{{__('On Location')}}</h2>
                <a href="{{route('event_more','location')}}" class="btn-read">{{__('Read More')}}</a>
            </div>
            <div class="row">
                @foreach($event_location as $one)
                    @php $count =0 @endphp
                    <div class="col-lg-4">
                        <div class="item-location wow fadeInUp">
                            <figure><img width="370px" height="237px" src="{{asset($one->image)}}"
                                         alt="Image Location"/></figure>
                            <div class="txt-location">
                                <h4>{!! $one->title !!}</h4>
                                <p>{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
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
                    @php $count++@endphp
                @endforeach
            </div>
        </div>
    </section>
    <!--section_location-->

    <section class="section_gear" id="Product">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>{{__('GEAR OF THE WEEK')}}</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumb-gear wow fadeInUp">
                        <img height="350px" width="350px" src="{{asset($setting->product->image)}}" alt=""/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="txt-gear wow fadeInUp">
                        <span>{!!  $setting->product->title!!} </span>
                        <p>
                            {!! Str::limit(strip_tags($setting->product->description ) ,  250)!!}
                        </p>
                        <a href="{{route('detail.product' ,$setting->product)}}"
                           class="btn-read">{{__('Read More')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_gear-->

    <section class="section_latest_blog" id="blog">
        <div class="container">
            <div class="sec_head wow fadeInUp">
                <h2>{{__('Latest Blog Posts')}}</h2>
                <a href="{{route('event_more','blog')}}" class="btn-read">{{__('Read More')}}</a>
            </div>
            <div class="row">
                @foreach($event_blog as $one)
                    @php $count =0 @endphp
                    <div class="col-lg-4">
                        <div class="item-location item-blog wow fadeInUp">
                            <figure><img width="356px" height="228px" src="{{ asset($one->image) }}"
                                         alt="Image Location"/></figure>
                            <div class="txt-location">
                                <h4>{!! $one->title !!}</h4>
                                <p>{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
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
                    @php $count++@endphp
                @endforeach
            </div>
        </div>
    </section>
    <!--section_location-->

    <section class="section_interviews" id="interview">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="sec_head wow fadeInUp">
                        <h2>{{__('Interviews')}}</h2>
                    </div>
                    <div class="cont-interview">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{route('details.event' , $event_interview1)}}">
                                    <div class="item-interview wow fadeInUp">
                                        <img width="403px" height="537px" src="{{$event_interview1->image}}"
                                             alt=""/>
                                        <div class="txt-interview">
                                            <p>{!! Str::limit(strip_tags($event_interview1->description ) ,  100)!!}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-column">
                                    @foreach($event_interview2 as $one)
                                        <a href="{{route('details.event' , $one)}}">
                                            <div class="item-interview wow fadeInUp">
                                                <img width="403px" height="258px" src="{{$one->image}}" alt=""/>
                                                <div class="txt-interview">
                                                    <p>{!! Str::limit(strip_tags($one->description ) ,  100)!!}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="head-adv wow fadeInUp">
                        <h2>{{__('Advertisment')}}</h2>
                    </div>
                    <div class="bd-adv">
                        @if($poster535)
                        <img src="{{asset('uploads/image/'.$poster535->image ?? '')}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_interviews-->

    <section class="section_advice" id="advice">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="sec_head">
                        <h2>{{__('Advice')}}</h2>
                        <a href="{{route('event_more','advice')}}" class="btn-read">{{__('Read More')}}</a>
                    </div>
                    <div class="cont-advice">
                        <div class="row">
                            @foreach($event_advice as $one)
                                @php $count =0 @endphp
                                <div class="col-lg-6">
                                    <div class="item-location item-blog wow fadeInUp">
                                        <figure><img width="403px" height="258px" src="{{asset($one->image)}}"
                                                     alt="Image Location"/></figure>
                                        <div class="txt-location">
                                            <h4>{!! $one->title !!}</h4>
                                            <p>{!! Str::limit(strip_tags($one->description ) ,  200)!!}</p>
                                            <a href="{{route('details.event' , $one)}}"
                                               class="btn-site"><span>{{__('Read More')}}</span></a>
                                        </div>
                                        <div class="fav-location">
                                            <a href=""><i
                                                    {{--                                                    {{($one->users->user_id == \Illuminate\Support\Facades\Auth::guard('web')->id() ?'fa-solid':'')}}--}}
                                                    class="
                                          @if($one->is_favourite==1) fa-solid @else fa-regular  @endif
                                                     fa-heart favorite_users"
                                                    data-id="{{$one->id}}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @php $count++@endphp
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="head-adv head-advice wow fadeInUp">
                        <h2>{{__('Advertisment')}}</h2>
                    </div>
                    <div class="bd-adv advice--bd">
                        @if($poster450)
                        <img src="{{asset('uploads/image/'.$poster450->image ?? '')}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section_advice-->

    <section class="section_gallery">
        <div class="container">
            <div class="sec_head">
                <h2>{{__('FEATURED GALLERY SUBMISSIONS')}}</h2>
            </div>
            <div class="owl-carousel carousel-gallery">
                @foreach($topcContestUser as $one)
                    <div class="item">
                        <div class="item-interview wow fadeInUp">
                            <img width="345px" height="221px" src="{{asset($one->image)}}" alt=""/>
                            <div class="txt-interview">
                                <p>{{$one->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="itm-ad">
                @if($poster_above)
                    <img src="{{asset('uploads/image/'.$poster_above->image) }}">
                @endif
            </div>
        </div>
    </section>
    <!--section_gallery-->

    <section class="section_page_site">
        <div class="container">
            <div class="cont-sign">
                <div class="head-sign">
                    <h3>{{__('Contact Us')}}</h3>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{'Error'}}!</strong>{{__('Wrong data entry')}}<br>
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-st form-register" action="#">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>{{__('Full Name')}}</label>
                                <input type="text" class="form-control" required
                                       name="name" id="InputName"
                                       value="{{old('name')}}"/>
                                <i class="fa-regular fa-user"></i>
                                <span class="text-danger" id="nameErrorMsg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="text" class="form-control" required name="email" id="InputEmail"
                                       value="{{old('email')}}"/>
                                <i class="fa-regular fa-envelope"></i>
                                <span class="text-danger" id="emailErrorMsg"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Phone')}}</label>
                                <input type="number" class="form-control" required
                                       name="mobile" value="{{old('mobile')}}" id="InputMobile"/>
                                <img src="{{asset('front/images/phone.svg')}}" alt=""/>
                                <span class="text-danger" id="mobileErrorMsg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>{{__('Message')}}</label>
                                <textarea style="resize:none ;  height: 100px" name="messages" id="InputMessage"
                                          required
                                          rows="30" cols="50" class="form-control">
                                    {{old('messages')}}
                                </textarea>
                                <span class="text-danger" id="messageErrorMsg"></span>

                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center mt-40">
                                <div class="form-group">
                                    <button type="button" class="btn-site click_action"><span>{{__('Send')}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--section_newslater-->
@endsection

@section('js')

    <script>
        $(document).on('click', '.click_action', function (e) {
            e.preventDefault();

            let name = $('#InputName').val();
            let email = $('#InputEmail').val();
            let mobile = $('#InputMobile').val();
            let message = $('#InputMessage').val();

            $.ajax({
                url: '{{ url('contactUs') }}',
                method: 'post',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                data: {
                    name: name,
                    email: email,
                    mobile: mobile,
                    message: message,
                },
                success: function (response) {
                    $('form').trigger("reset");
                    swal.fire(response.message, 'Message', "success");
                },
                error: function (error) {
                    $('#nameErrorMsg').text(error.responseJSON.errors.name);
                    $('#emailErrorMsg').text(error.responseJSON.errors.email);
                    $('#mobileErrorMsg').text(error.responseJSON.errors.mobile);
                    $('#messageErrorMsg').text(error.responseJSON.errors.message);
                }
            });


        });
    </script>
@endsection

