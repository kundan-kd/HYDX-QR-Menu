<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $item_id = intval($request->id);
        $item_quantity = intval($request->quantity);
        $item_price = floatval($request->offer_price);
        $total_price = $item_quantity * $item_price;
        $product = Item::where('id', $item_id)->first();
        if (is_null($product)) {
            return response()->json([
                'error' => 'Product not found'
            ]);
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $item_quantity;
            $cart[$product->id]['price'] += $total_price;
            if ($cart[$product->id]['quantity'] <= 0) {
                unset($cart[$product->id]);
            }
        } else {
            if ($item_quantity > 0) {
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->item_name,
                    'quantity' => $item_quantity,
                    'price' => $total_price,
                    'f_category' => $product->f_category
                ];
            }
        }
        session()->put('cart', $cart);
        return response()->json(['success' => 'Product added to cart', 'cart' => array_values($cart)]);
    }
    public function clearCartItems(Request $request)
    {
        $cart_id = $request->id;
        $cart = session()->get('cart', []);
        if (isset($cart[$cart_id])) {
            unset($cart[$cart_id]);
        }
        session()->put('cart', $cart);
        return response()->json(['success' => 'Item Removed Successfully', 'cart' => array_values($cart)]);
    }
    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => 'Cart Cleared Successfully']);
    }
}
