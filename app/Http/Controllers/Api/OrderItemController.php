<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class OrderItemController extends Controller
{
    use ApiResponseTrait;

    // عرض جميع عناصر الطلب مع اسم المنتج
    public function index()
    {
        $items = OrderItem::with(['order', 'product:id,name'])->get();

        // إضافة اسم المنتج لكل عنصر
        $items->each(function ($item) {
            $item->product_name = $item->product->name ?? null;
        });

        return $this->success('تم عرض عناصر الطلب بنجاح', $items);
    }

    // إنشاء عنصر طلب جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $item = OrderItem::create($data)->load('product:id,name');
        $item->product_name = $item->product->name ?? null;

        return $this->success('تم إنشاء عنصر الطلب بنجاح', $item, 201);
    }

    // عرض عنصر طلب مع اسم المنتج
    public function show(OrderItem $orderItem)
    {
        $orderItem->load(['order', 'product:id,name']);
        $orderItem->product_name = $orderItem->product->name ?? null;

        return $this->success('تم عرض عنصر الطلب بنجاح', $orderItem);
    }

    // تحديث عنصر الطلب
    public function update(Request $request, OrderItem $orderItem)
    {
        $data = $request->validate([
            'order_id'   => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity'   => 'sometimes|integer|min:1',
            'price'      => 'sometimes|numeric|min:0',
        ]);

        $orderItem->update($data);
        $orderItem->load('product:id,name');
        $orderItem->product_name = $orderItem->product->name ?? null;

        return $this->success('تم تحديث عنصر الطلب بنجاح', $orderItem);
    }

    // حذف عنصر الطلب
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return $this->success('تم حذف عنصر الطلب بنجاح');
    }
}