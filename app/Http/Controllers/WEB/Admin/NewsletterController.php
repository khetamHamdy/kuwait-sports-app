<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Exports\SubscribeExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Contest;
use App\Models\Event;
use App\Models\Subscribe;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $subscribe = Subscribe::filter($request)->latest()->paginate();

        return view('admin.subscribe.home', compact('subscribe'));
    }

//user web store
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $isSubscribed = Subscribe::where('email', '=', $request->email)->first();
        if (!$isSubscribed) {
            Subscribe::create([
                'email' => $request->email,
                'sender_name' => Auth::guard('user')->user()->first_name,
            ]);
            return redirect('newsletter')->with('success', __('Thanks For Subscribe'));
        }
        return redirect('newsletter')->with('failure', __('Sorry! You have Already Subscribed'));

    }

    public function export_subscribe(Request $request)
    {
//        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف إكسل لبيانات المستخدمين ');
//        return Excel::download(new UsersExport($request), 'users.xlsx');

        return Excel::download(new SubscribeExport(), 'Subscribes.xlsx');
    }

    public function pdf_subscribe(Request $request)
    {
        $subscribe = Subscribe::latest()->paginate();

        $data = [
            'title' => 'Welcome to kuwait',
            'date' => date('m/d/Y'),
            'subscribe' => $subscribe
        ];

        $pdf = PDF::loadView('admin.subscribe.export_pdf', $data);

        return $pdf->download('subscribe.pdf');
    }

    public function edit(Subscribe $subscribe)
    {
        return view('admin.subscribe.edit', compact('subscribe'));
    }

    public function update(Request $request, Subscribe $subscribe)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $subscribe->update([
            'email' => $request->email,
            'sender_name' => $request->sender_name,
            'status' => $request->status
        ]);
        return redirect()->route('admin.newsletter.index')->with('info',__('done_update'));

        //return redirect('newsletter')->with('failure', 'Sorry! You have already subscribed ');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteNewsletter(Request $request)
    {
        $ids = $request->ids;
        DB::table("subscribes")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' =>  __('done_deleted')]);
    }
}
