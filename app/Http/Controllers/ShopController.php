<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('categories')->first();


        $productThree = Product::with('categories')->whereIn('id',[2,3,4])->get();

        $productOthers = Product::with('categories')->where('id', '!=', 1,)
            ->where('id', '!=', 2)
            ->where('id', '!=', 3)
            ->where('id', '!=', 4)
            ->paginate(10);

        return Inertia::render('Shop/Index', [
            'product' => $product,
            'productThree' => $productThree,
            'productOthers' => $productOthers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Shop/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug(Request::input('name'));
        $input = Request::validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'price' => 'integer|required',
            'file_upload' => 'required|file'
        ]);
        $product = Product::create(array_merge($input, ['slug' => $slug]));

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
    public function show($id)
    {
        $product = Product::with('categories')->findOrfail($id);

        return Inertia::render('Shop/Show', [
            'product' => $product
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
}
