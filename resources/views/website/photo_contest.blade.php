@extends("layouts.siteLayout")
@section('title')
    Photo Contest
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="head-page d-flex align-items-center justify-content-between">
                <h4>{{__('Photo Contest')}}</h4>
                <a href="{{route('contest.create')}}" class="btn-add">{{__('Add Photo')}}</a>
            </div>
            <div class="content-contest">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($all_contest as $one)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{($one->closed_contest == 0) ? 'active' : '' }}"
                                    id="contest-tab-{{$one->id}}"
                                    data-bs-toggle="tab" data-bs-target="contest-tab-{{$one->id}}"
                                    type="button" role="tab" aria-controls="contest-tab-{{$one->id}}"
                                    aria-selected="true">{{ $one->title }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    @foreach($all_contest as $one)
                        <div class="tab-pane fade show  {{($one->closed_contest == 0) ? 'active' : '' }}"
                             id="contest-tab-{{$one->id}}" role="tabpanel"
                             aria-labelledby="contest-tab-{{$one->id}}">
                            <div class="row">
                                @foreach($contest_user->where('contest_id' ,$one->id) as $user_img)

                                    <div class="col-lg-4">
                                        <div class="item-photo-contest">
                                            <figure><img src="{{asset($user_img->image) }}" alt=""/></figure>
                                            <div class="txt-photo-contest">
                                                <h4>{{$user_img->name}}</h4>
                                                <p><span
                                                        class="count_txt_{{$user_img->id}}">{{$user_img->count_like}}</span><i
                                                        class="@if($user_img->is_favourite==1) fa-solid @else fa-regular  @endif  fa-heart favorite_contest"
                                                        data-id="{{$user_img->id}}"></i></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--section_gallery_event-->
@endsection
@section('js')
    <script>

        $(document).on('click', '.favorite_contest', function (e) {
            e.preventDefault();
            var contest_id = $(this).data('id');
            var vm = $(this);
            var idCount = $('.count_txt_' + contest_id);
            var _prevCount = $('.count_txt_' + contest_id).text();

            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: "{{url('Favorite/')}}/" + contest_id + "/" + {{\Illuminate\Support\Facades\Auth::id() ?? 3}},
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
