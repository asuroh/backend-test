<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

     /**
     * Proses pembayaran
     */
    public function processPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Simulasikan pembayaran berhasil
        $order->update(['status' => 'completed']);


        $invoice = Invoice::findOrFail($orderId);
        $invoice->update(['status' => 'paid']);

        return response()->json(['message' => 'Payment processed successfully']);
    }
}
