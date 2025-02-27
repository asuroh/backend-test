<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Invoice;

class InvoiceController extends Controller
{

    // Buat invoice
    public function generateInvoice(Request $request, $orderId)
    {
        $request->validate([
            'invoice_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
        ]);
   
        $order = Order::findOrFail($orderId);
   
        // Hitung total amount dengan diskon
        $totalAmount = $order->total_amount - ($request->discount ?? 0);
   
        $invoice = $order->invoice()->create([
            'invoice_date' => $request->invoice_date,
            'total_amount' => $totalAmount,
            'status' => 'unpaid',
        ]);
   
        return response()->json($invoice, 201);
    }
   
    // Buat backdated invoice
    public function generateBackdatedInvoice(Request $request, $orderId)
    {
        $request->validate([
            'invoice_date' => 'required|date|before_or_equal:today',
            'discount' => 'nullable|numeric|min:0',
        ]);
   
        $order = Order::findOrFail($orderId);
   
        // Hitung total amount dengan diskon
        $totalAmount = $order->total_amount - ($request->discount ?? 0);
   
        $invoice = $order->invoice()->create([
            'invoice_date' => $request->invoice_date,
            'total_amount' => $totalAmount,
            'status' => 'unpaid',
        ]);
   
        return response()->json($invoice, 201);
    }
}
