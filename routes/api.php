<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->middleware('auth:sanctum');
Route::post('/orders/{orderId}/pay', [PaymentController::class, 'processPayment'])->middleware('auth:sanctum');
Route::post('/orders/{orderId}/invoice', [InvoiceController::class, 'generateInvoice'])->middleware('auth:sanctum');
Route::post('/orders/{orderId}/backdated-invoice', [InvoiceController::class, 'generateBackdatedInvoice'])->middleware('auth:sanctum');
