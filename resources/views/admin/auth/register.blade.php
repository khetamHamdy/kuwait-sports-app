@extends('admin.auth.layout_auth.app')
@section('content')
    <form class="formLogin" role="form" action="{{route('admin.register')}}" enctype="multipart/form-data"
          method="post">
        @csrf
        <div class="form-group form-group-default">
            <label>{{__('name')}}</label>
            <div class="controls">
                <input name="name" value="{{old('name')}}" type="text" class="form-control" required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group form-group-default">
            <label>{{__('email')}}</label>
            <div class="controls">
                <input name="email" type="email" class="form-control" value="{{old('email')}}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group form-group-default">
            <label>{{__('mobile')}}</label>
            <div class="controls">
                <input name="mobile" type="text" class="form-control" value="{{old('mobile')}}" required>

                @if ($errors->has('mobile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group form-group-default">
            <label>{{__('password')}}</label>
            <div class="controls">
                <input type="password" class="form-control" required="" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
        </div>

        <div class="form-group form-group-default">
            <label>{{__('Confirm Password')}}</label>
            <div class="controls">
                <input type="password" class="form-control" required="" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif

            </div>
        </div>

        <button class="btn btnSub" style="color: white; background: rgb(210 62 7); border: 0"
                type="submit">{{__('Sign in')}}</button>
    </form>
@endsection
