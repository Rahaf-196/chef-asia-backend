<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Traits\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     *  عرض جميع الطلبات (خاص بالأدمن فقط)
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin') {
            return $this->error('Unauthorized access', 403);
        }

        $orders = Order::with('items.product', 'user')->latest()->get();

        return $this->success('Orders retrieved successfully', $orders);
    }

    /**
     *  عرض الطلبات الخاصة بالمستخدم المسجل (لصفحة البروفايل)
     */
    public function userOrders()
    {
        $user = auth()->user();

        if (!$user) {
            return $this->error('Unauthorized', 403);
        }

        $orders = Order::with('items.product')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        return $this->success('User orders retrieved successfully', $orders);
    }

    /**
     *  إنشاء طلب جديد
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || !is_array($request->items)) {
            return $this->error('Invalid request format', 400);
        }

        $validated = $request->validate([
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'nullable|numeric',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $validated['payment_method'],
            'total_price' => $validated['total_price'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_address' => $validated['customer_address'],
            'order_date' => now()->toDateString(),
        ]);

        foreach ($validated['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'] ?? 0,
            ]);
        }

        $order->load('items.product');

        return $this->success('Order placed successfully', $order, 201);
    }
}
