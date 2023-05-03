@extends("layouts.siteLayout")
@section('title')
    {{__('Contact')}}
@endsection
@section('css')
@endsection
@section("content")
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
    <!--section_home-->
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

