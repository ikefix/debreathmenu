<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompletedOrder;

class OrderController extends Controller
{
    public function complete(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        CompletedOrder::create([
            'items' => $cart,
            'total_price' => $totalPrice,
        ]);

        session()->forget('cart'); // Clear cart

        return redirect()->back()->with('success', 'Order completed ✅');
    }



    // Show all orders to admin
public function index()
{
    $orders = CompletedOrder::orderBy('created_at', 'desc')->get();
    return view('orders.order', compact('orders'));
}

// Update order status
public function updateStatus(Request $request, CompletedOrder $order)
{
    $request->validate([
        'status' => 'required|in:uncompleted,in_progress,completed'
    ]);

    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Order status updated!');
}

}
