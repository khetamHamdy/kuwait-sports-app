<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Contest;
use App\Models\ContestUser;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Route;

class UserContestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use imageTrait;

//    public function contest_participants(Request $request, $id )
//    {
//
//        $this->winner($id);
//        $params = $request->status;
//        //$dataContest = ContestUser::with(['user', 'contest'])->filter($params)->latest()->paginate();
//        $dataContest = ContestUser::where('contest_id', $id)->with(['user', 'contest'])->filter($params)->paginate();
//        //return $dataContest;
//        return view('admin.contest.home', compact('dataContest'));
//    }

    public function index(Request $request, $contest_id )
    {
        $params = $request->status;
        //$dataContest = ContestUser::with(['user', 'contest'])->filter($params)->latest()->paginate();
        $dataContest = ContestUser::where('contest_id', $contest_id)->with(['user', 'contest'])->filter($params)->paginate();
        //return $dataContest;
        return view('admin.contest.home', compact('dataContest'));
    }

    /**
     * Display the specified resource.
     *
     * @param ContestUser $contestUser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function show(ContestUser $usercontest)
    {
        return view('admin.contest.show', compact('usercontest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ContestUser $usercontest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function edit(ContestUser $usercontest)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];

        return view('admin.contest.edit', compact('status', 'usercontest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ContestUser $contestUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request, ContestUser $contestUser)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $this->Roles($request);

            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }

            $contestUser->update($data);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        if ($contestUser) {
            return redirect()->route('participants.contest' ,$contestUser )->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }


    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['description'] = 'required|string';
        $roles['status'] = 'nullable|in:active,not_active';

        $data = $this->validate($request, $roles);
    }

    public function getItems($req, $event_id)
    {
        $event = Event::findOrFail($event_id);

        if ($req === 'image') {
            $view = view('admin.products.components.images', ['event' => $event])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'home') {
            $view = view('admin.products.components.home', ['event' => $event])->render();
            return response()->json(['items' => $view]);
        }
    }

    public function deleteProductImage($product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        $productImage->delete();
        return response()->json(['message' => __('done_deleted')]);
    }
}
