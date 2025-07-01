<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductController_Admin;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\AuthController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Sanctum CSRF cookie route
Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public data
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

// Contact Us open to public
Route::post('/contacts', [ContactController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated via Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ استرجاع الطلبات الخاصة بالمستخدم الحالي فقط
   Route::get('/user/orders', [OrderController::class, 'userOrders']);
    // Check role for Admin
    Route::get('/check-role', function (Request $request) {
        return response()->json(['role' => $request->user()->role]);
    });

    // Admin-only routes
    Route::get('/admin/orders', [OrderController::class, 'index']);

    Route::prefix('admin')->group(function () {
        Route::post('/products', [ProductController_Admin::class, 'store']);
        Route::put('/products/{id}', [ProductController_Admin::class, 'update']);
        Route::delete('/products/{id}', [ProductController_Admin::class, 'destroy']);
    });

    // Categories management
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Products CRUD (except index which is public)
    Route::apiResource('products', ProductController::class)->except(['index']);

    // Orders & Order Items
    Route::apiResource('orders', OrderController::class);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::apiResource('order-items', OrderItemController::class);

    // Other resources (admin usage)
    Route::apiResource('contacts', ContactController::class)->except(['store']);
    Route::apiResource('settings', SettingController::class);
});

/*
|--------------------------------------------------------------------------
| Authenticated Check Endpoint
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->get('/check-user', function (Request $request) {
    return response()->json([
        'authenticated' => true,
        'user' => $request->user(),
    ]);
});

Route::middleware('auth:sanctum')->get('/check-role', function (Request $request) {
    return response()->json([
        'role' => $request->user()->role,
    ]);
});
