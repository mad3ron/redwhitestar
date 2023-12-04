<?php

namespace App\Http\Controllers\Cso;

use App\Http\Controllers\Controller;
use App\Models\Cso\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('cso.order.index');
    }

    public function create(Request $request)
    {
        $order = Order::create([
            'name' => $request->input('name'), // Menggunakan input dari request
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
            'qty' => $request->input('qty'),
            'harga' => $request->input('qty') * 10000,
            'status' => 'unpaid',
        ]);
    }

    public function checkout(Request $request)
    {
        // Membuat array data tambahan
        $additionalData = ['harga' => $request->qty * 10000, 'status' => 'unpaid'];

        // Menggabungkan data tambahan ke dalam request
        $request->merge($additionalData);

        $order = Order::create($request->all());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('mintran.serve_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->harga,
            ),
            'customer_details' => array(
                'name' => $request->name,
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        dd($snapToken);
        return view('checkout', compact('snapToken', 'order'));
    }
}
