@extends("layouts.siteLayout")
@section('title')
    {{__('contest')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="head-page d-flex align-items-center justify-content-between">
                <h4>{{__('Media')}}</h4>
            </div>

            <div class="content-tb">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos"
                                type="button" role="tab" aria-controls="photos"
                                aria-selected="true">{{__('Show Photos')}}
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
                            @foreach($media as $one)
                                @if($one->video)
                                    <div class="col-lg-6">
                                        <div class="item-gallery item-photo-contest">
                                            <a href="{{asset($one->video)}}" data-fancybox="gallery">
                                                <video src="{{asset($one->video)}}" width="500px"
                                                       height="400px"></video>
                                            </a>
                                            {{--                                            <div class="txt-photo-contest">--}}
                                            {{--                                                <p><span class="count_txt_{{$one->id}}">{{$one->count_like}}</span>--}}
                                            {{--                                                    <i--}}
                                            {{--                                                        class="@if($one->is_favourite==1) fa-solid @else fa-regular  @endif fa-heart favorite_contest_admin"--}}
                                            {{--                                                        data-id="{{$one->id}}"></i></p></div>--}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <div class="row">
                            @foreach($media as $one)
                                @if($one->image)
                                    <div class="col-lg-4">
                                        <div class="item-gallery item-photo-contest">
                                            <a href="{{asset($one->image)}}" data-fancybox="gallery"><img
                                                    src="{{asset($one->image)}}" width="500px" height="400px"
                                                    alt=""/></a>

                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--section_gallery_event-->

    <section class="section_data_event">
        <div class="container">
            <div class="our-logo">
                <h4>{{__('Our Logo')}}</h4>
                <p>{{$setting->text_ourLogo}}</p>
                <div class="lst-logo">
                    <div class="item-logo">
                        <p>{{__('Primary Logo')}}</p>
                        <div class="download0--logo">
                            <figure><img src="{{asset($setting->primaryLogo)}}" alt=""/></figure>
                            <a href="{{asset($setting->primaryLogo)}}" download><i
                                    class="fa-solid fa-cloud-arrow-down"></i> {{__('Download')}}</a>
                        </div>
                    </div>
                    <div class="item-logo">
                        <p>{{__('Secondary Logo')}}</p>
                        <div class="download0--logo">
                            <figure><img src="{{asset($setting->secondaryLogo)}}" alt=""/></figure>
                            <a href="{{asset($setting->secondaryLogo)}}" download><i
                                    class="fa-solid fa-cloud-arrow-down"></i> {{__('Download')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-media">
                <h4>{{__('Social Media')}}</h4>
                <p>{{$setting->text_socialMedia}}</p>
                <ul>
                    <li><a href="{{ $setting->youTube }}"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="{{ $setting->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="{{ $setting->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>

        $(document).on('click', '.favorite_contest_admin', function (e) {
            e.preventDefault();
            var contest_id = $(this).data('id');

            var vm = $(this);
            var idCount = $('.count_txt_' + contest_id);
            var _prevCount = $('.count_txt_' + contest_id).text();
            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: "{{url('contest_admin/')}}/" + contest_id + "/" + {{\Illuminate\Support\Facades\Auth::id() ?? 3}},
                dataType: 'json',
                success: function (response) {
                    if (response.bool == true) {
                        _prevCount++;
                        vm.removeClass('fa-regular').addClass('fa-solid');
                        idCount.text(_prevCount);
                    }
                    if (response.messages) {
                        _prevCount--;
                        vm.removeClass('fa-solid').addClass('fa-regular');
                        idCount.text(_prevCount);
                    }
                },
                error: function (jqXHR, error, errorThrown) {
                    swal.fire("Please make a login to be able to work like", contest_id, "info");
                }
            });

        });
    </script>
@endsection
