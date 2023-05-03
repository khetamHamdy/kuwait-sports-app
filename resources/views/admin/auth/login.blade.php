@extends('admin.auth.layout_auth.app')
@section('content')
    <form  id="formLogin" class="formLogin" role="form" action="{{route('admin.login')}}"
          method="post">
        @csrf
        <div class="form-group form-group-default">
            <label>{{__('email')}}</label>
            <div class="controls">
                <input name="email" type="email" class="form-control" required>
            </div>
        </div>
        <div class="form-group form-group-default">
            <label>{{__('password')}}</label>
            <div class="controls">
                <input type="password" class="form-control" required="" name="password">
            </div>
        </div>

        <button class="btn btnSub btn-primary" style="color: white; background: rgb(210 62 7); border: 0;padding: 9px"
                type="submit">{{__('Sign in')}}</button>
    </form>
@endsection
