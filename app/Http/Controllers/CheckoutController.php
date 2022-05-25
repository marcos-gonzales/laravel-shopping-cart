<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CheckoutController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $order = Order::where('user_id', auth()->user()->id)
            ->where('is_complete', null);
        if($order) {
            $order = Order::updateOrCreate([
                'user_id' => auth()->user()->id,
                'transaction_id' => null,
                'total' => $product->price
            ]);
        } else {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'transaction_id' => null,
                'total' => $product->price
            ]);

        }
        $order->products()->attach(['product_id' => $product->id]);
        $order->syncChanges();

        return redirect()->back()->with('success', 'added to cart.');
    }

    public function index()
    {
        $productsInCart = Order::with('products')
            ->where('user_id', auth()->user()->id)
            ->where('is_complete',  null)
            ->withSum('products', 'price')
            ->get();
        return Inertia::render('Product/Checkout',[
            'productsInCart' => $productsInCart,
        ]);
    }

    public function destroy($product)
    {
        $order = Order::where('user_id', auth()->user()->id)
            ->where('is_complete', null)
            ->with(['products' => function($query) use($product) {
            $query->where('product_id', $product);
        }])->first();
        $order->delete();
        return redirect()->back()->with('success', 'item deleted from cart.');
    }

    public function processPayment(Request $request)
    {
        try {
        $stripeCharge = $request->user()->charge(
            $request->user['customerAmount'], $request->user['paymentMethodId']
        );

        $order = Order::where('user_id', auth()->user()->id)->first();
        $order->is_complete =  1;
        $order->save();
        return redirect()->route('checkout.summary')->with('success', 'Order has been processed');

        } catch(Exception $e) {
            throw new Exception("Something went wrong $e");
        }
    }

    public function summary()
    {
        dd("hi");
    }
}

