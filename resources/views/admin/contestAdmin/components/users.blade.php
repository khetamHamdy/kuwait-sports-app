
<div class="card card-custom gutter-b example example-compact" style="padding: 30px">
    <div class="table-responsive">
        <table class="table table-hover tableWithSearch" id="tableWithSearch">
            <thead>
            <tr>
                <th class="wd-5p">{{Lang::get('image')}}</th>
                <th class="wd-5p"> {{ucwords(__('Full Name'))}}</th>
                <th class="wd-5p"> {{ucwords(__('Email'))}}</th>
                <th class="wd-5p"> {{ucwords(__('phone'))}}</th>
                <th class="wd-5p"> {{ucwords(__('Status'))}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($contest->users as $one)
                <tr class="odd gradeX">
                    <td class="v-align-middle wd-5p"><img
                            src="{{ asset($one->image) }}"
                            width="90px"
                            height="90px"></td>
                    <td class="v-align-middle wd-25p">{{  $one->first_name ." ". $one->last_name }}</td>
                    <td class="v-align-middle wd-25p">{{  $one->email }}</td>
                    <td class="v-align-middle wd-25p">{{  $one->phone }}</td>

                    <td class="v-align-middle wd-10p"> <span
                            id="label-{{$one->id}}" class="badge badge-pill badge-{{($one->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$one->id}}">
                                          {{__($one->status)}}  </span></td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

