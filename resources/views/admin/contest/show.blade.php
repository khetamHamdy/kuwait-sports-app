@extends('admin.contest.sideMenu')
@section('companyContent')
    <div class="container item_box">
        <div class="card card-custom gutter-b example example-compact" style="padding: 30px">
            <div class="flex-row-fluid ml-lg-8">
                <div class="row">

                    <h3 class="text-capitalize">{{__('Contest')}}:</h3>

                    <div class="table-responsive">
                        <table class="table table-hover tableWithSearch" id="tableWithSearch">
                            <thead>
                            <tr>
                                <th class="wd-5p"> {{ucwords(__('image'))}}</th>
                                <th class="wd-5p"> {{ucwords(__('Description'))}}</th>
                                <th class="wd-5p"> {{ucwords(__('Likes Total'))}}</th>
                                <th class="wd-5p"> {{ucwords(__('Winner'))}}</th>
                                <th class="wd-5p"> {{ucwords(__('Status'))}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td class="v-align-middle wd-5p"><img
                                        src="{{ asset($usercontest->image) }}"
                                        width="90px" height="90px"></td>

                                <td class="v-align-middle wd-25p">{!! Str::limit(strip_tags($usercontest->description ) ,  100)!!}</td>

                                <td class="v-align-middle wd-25p">{{  $usercontest->count_like }}</td>

                                <td class="v-align-middle wd-10p">
                                            <span id="label-{{$usercontest->id}}" class="badge badge-pill badge-{{ ($usercontest->winner == 'true')
                                            ? "success" : "danger"}}" id="label-{{$usercontest->id}}">
                                                @if($usercontest->winner == 'true')
                                                    winner
                                                @else
                                                    not winner
                                                @endif
                                            </span></td>

                                <td class="v-align-middle wd-10p"> <span id="label-{{$usercontest->id}}" class="badge badge-pill badge-{{($usercontest->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$usercontest->id}}">

                                            {{__($usercontest->status)}}
                                        </span>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
