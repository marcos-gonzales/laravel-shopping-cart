<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Http\Requests\CheckoutRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CheckoutController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $order = Order::getOrder();
        if($order->count() == 0) {
          $order = Order::create([
                'user_id' => auth()->user()->id,
                'transaction_id' => null,
                'total' => $product->price,
                'is_complete' => 0
            ]);
        } else {
            $order->update([
                'user_id' => auth()->user()->id,
                'transaction_id' => null,
                'total' => $order->total + $product->price,
                'is_complete' => 0
            ]);
        }

        $order->products()->attach(['product_id' => $product->id]);
        $order->syncChanges();

        return redirect()->back()->with('success', 'added to cart.');
    }

    public function index()
    {
        return Inertia::render('Checkout/Checkout',[
            'productsInCart' => Order::productsInCart(),
        ]);
    }

    public function destroy($product)
    {
        Order::removeProductFromCart($product);

        return redirect()->back()->with('success', 'item deleted from cart.');
    }

    public function processPayment(Request $request)
    {
//        try {
        $stripeCharge = $request->user()->charge(
            $request->user['customerAmount'] * 100, $request->user['paymentMethodId']
        );

        $order = Order::productsInCart()[0];
        $order->is_complete = 1;
        $order->save();

        event(new ProductOrdered($order, auth()->user()));

        return redirect()->route('checkout.summary', ['order' => $order])->with('success', 'Order has been processed');

//        } catch(Exception $e) {
//            throw new Exception("Something went wrong $e");
//        }
    }

    public function summaryIndex()
    {
        return Inertia::render('Checkout/SummaryIndex', [
            'orders' => Order::getOrders()
        ]);
    }

    public function summaryShow(Order $order)
    {
        $category = $order->products->load('categories')->first()->categories->first();

        return Inertia::render('Product/Summary',[
            'order' => $order->products->load('categories'),
            'similarProducts' => Category::similarProducts($category)
        ]);
    }
}

