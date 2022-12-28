<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
        ->where('customer_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cart',
            'cart' => $carts
        ]);
    }

    public function store(Request $request)
    {
        $item = Cart::where('product_id', $request->product_id)
        ->where('customer_id', $request->customer_id);
        // dd($request->all());
        //jika data cart sudah ada, update quantity, price, dan weight
        if($item->count())
        {
            //increment quantity
            $item->increment('quantity');
            $item = $item->first();
            //sum price * qty
            $price = $request->price * $item->quantity;
            //sum weight
            $weight = $request->weight * $item->quantity;
            $item->update([
                'price' => $price,
                'weight' => $weight
            ]);
        }
        //jika belum ada, buat cart baru
        else {
            $item = Cart::create([
                'product_id' => $request->product_id,
                'customer_id' => $request->customer_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'weight' => $request->weight,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success Add To Cart',
            'quantity' => $item->quantity,
            'product' => $item->product
        ]);
    }

    public function getCartTotal()
    {
        $carts = Cart::with('product')
        ->where('customer_id', auth()->guard('api')->user()->id)
        ->orderBy('created_at', 'desc')
        ->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Price',
            'total' => $carts
        ]);
    }

    public function getCartTotalWeight()
    {
        $carts = Cart::with('product')
        ->where('customer_id', auth()->guard('api')->user()->id)
        ->orderBy('created_at', 'desc')
        ->sum('weight');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Weight',
            'total' => $carts
        ]);
    }

    public function removeCart(Request $request)
    {
        $cart = Cart::with('product')
        ->whereId($request->cart_id)
        ->delete();

        if($cart){
            return response()->json([
                'success' => true,
                'message' => 'Removed Item in Cart'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Failed Removed Item from Cart'
        ]);

    }

    public function removeAllCart(Request $request)
    {
        Cart::with('product')
        ->where('customer_id', auth()->guard('api')->user()->id)
        ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed All Item in Cart'
        ]);
    }
}
