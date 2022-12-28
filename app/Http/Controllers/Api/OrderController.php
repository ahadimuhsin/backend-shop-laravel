<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('customer_id', auth()->guard('api')->user()->id)
        ->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Invoices: '.auth()->guard('api')->user()->name,
            'data' => $invoices
        ]);
    }

    public function show($snap_token)
    {
        $invoice = Invoice::where('customer_id', auth()->guard('api')->user()->id)
        ->where('snap_token', $snap_token)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail Invoice: '.auth()->guard('api')->user()->name,
            'data' => $invoice,
            'product' => $invoice->orders
        ]);
    }
}
