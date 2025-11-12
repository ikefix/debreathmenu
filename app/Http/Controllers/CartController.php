<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $food = Food::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            // Item already exists, increase quantity
            $cart[$id]['quantity']++;
        } else {
            // New item
            $cart[$id] = [
                'name' => $food->name,
                'price' => $food->price,
                'quantity' => 1,
                'image' => $food->image_url ?? null,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', $food->name.' added to cart');
    }



    public function remove($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item removed from cart');
}

}
