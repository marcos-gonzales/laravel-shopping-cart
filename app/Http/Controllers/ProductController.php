<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product) :Response
    {
        return Inertia::render('Product/Index', [
            'products' => Product::getProducts()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() :Response
    {
        return Inertia::render('Product/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $slug = Str::slug(Request::input('name'));
        $product = Product::create(array_merge($request->validated(), ['slug' => $slug, 'price' => $request->price * 100]));

        $image = Request::file('file_upload')->getClientOriginalName();
        Request::file('file_upload')->storeAs('public/products/' .$product->id, $image);

        $product->update(['file_path' => $image]);
        $product->categories()->attach(Request::input('category'));

        return redirect()->route('shop.index')->with('success', 'Product successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) :Response
    {
        return Inertia::render('Product/Show', [
            'product' => Product::showProduct($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout() :Response
    {
        return Inertia::render('Product/Checkout');
    }
}
