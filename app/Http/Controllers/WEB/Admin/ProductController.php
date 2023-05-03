<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use imageTrait;

    public function __construct()
    {
        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {
//            if (can('admins')) {
//                return $next($request);
//            }
            if ($route_name == 'index') {
                if (can(['product-show', 'product-create', 'product-edit', 'product-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('product-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('product-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('product-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }
    public function index(Request $request)
    {
        $params = $request->title;
        $dataProduct = Product::filter($params)->latest()->paginate();

        return view('admin.products.home', compact('dataProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];

        return view('admin.products.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->Roles($request);
        DB::beginTransaction();
        try {

            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }

            $product = Product::create($data);

            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $product->productImages()->create(
                        ['product_id' => $product->id, 'image' => $image_url]);
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        if ($product) {
            return redirect()->route('admin.product.index')->with('success',  __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function edit(Product $product)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];

        return view('admin.products.edit', compact('status', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $this->Roles($request);

            if ($request->hasFile('video')) {
                $data['video'] = $this->vidoe($request, 'video');
            }

            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }

            $product->update($data);

            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $product->productImages()->create(
                        ['product_id' => $product->id, 'image' => $image_url]);
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        if ($product) {
            return redirect()->route('admin.product.index')->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Product $product)
    {
        if ($product) {
            $product->delete();
            return redirect()->route('admin.product.index')->with('info', __('done_deleted'));
        }
    }

    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['link'] = 'required|url';
        $roles['status'] = 'nullable|in:active,not_active';

        foreach (config('app.languages') as $locale => $lang) {
            $roles ["$locale.title"] = 'required|string';
            $roles ["$locale.description"] = 'required|string';
        }
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
        return response()->json(['message' =>  __('done_deleted')]);
    }
}
