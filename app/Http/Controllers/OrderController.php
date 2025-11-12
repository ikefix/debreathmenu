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
}
