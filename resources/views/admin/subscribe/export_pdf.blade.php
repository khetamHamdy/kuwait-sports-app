@extends('layouts.exportPdfLayout')
@section('content')
    <tr>
        <th>ID</th>
        <th>@lang('name')</th>
        <th>@lang('email')</th>
        <th>@lang('status')</th>
        <th>@lang('created')</th>
    </tr>
    @foreach($subscribe as $one)
        <tr>
            <td>{{$one->id}}</td>
            <td>{{$one->sender_name}}</td>
            <td>{{$one->email}}</td>
            <td>{{$one->status=='active'?__('active') : __('not_active')}}</td>
            <td>{{$one->created_at->format('Y-m-d')}}</td>

        </tr>
    @endforeach
@endsection
