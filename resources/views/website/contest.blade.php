@extends("layouts.siteLayout")
@section('title')
    {{__('Contest')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="row color-white">
                <h2>{{ __('Contest terms')}}</h2>
                <p class="text-white">{!! $contest->description ?? "" !!}</p>
            </div>
            <div class="cont-sign">
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

                <form class="form-st form-register" action="{{route('contest.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <input type='hidden' name="contest_id" value="{{$contest->id ?? ''}}"/>

                        <div class="row">
                            <!--begin::Group-->
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image"
                                           value="{{old('image')}}"/>
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url();">
                                    </div>
                                </div>
                            </div>
                            <!--end::Group-->
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>{{__('description image')}}</label>
                                        <textarea style="resize:none ;  height: 100px" name="description" id="Message"
                                                  rows="30" cols="50" class="form-control">
                                    {{old('description')}}
                                </textarea>

                                    </div>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center mt-40">
                                        <div class="form-group">
                                            <button type="submit" class=btn-site click_action_contest
                                            "><span>{{__('Add')}}</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--section_home-->
@endsection
@section('js')
    <script>
        new WOW().init();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>

@endsection


