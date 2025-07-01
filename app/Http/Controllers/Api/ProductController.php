<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class ProductController extends Controller
{
    use ApiResponseTrait;

    //  عرض جميع المنتجات (مع تصفية اختيارية حسب التصنيف)
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();

        //  تحويل الصورة إلى رابط كامل إذا لم تكن http
        $products->transform(function ($product) {
    if (!str_starts_with($product->image, 'http')) {
        $product->image = 'http://localhost:8888/' . $product->image;
    }
    return $product;
});

        return $this->success('تم عرض المنتجات بنجاح', $products);
    }

    //  عرض منتج واحد بالتفاصيل
    public function show(Product $product)
    {
        $product->load('category');

        if (!str_starts_with($product->image, 'http')) {
            $product->image = asset($product->image);
        }

        return $this->success('تم عرض المنتج بنجاح', $product);
    }

    //  إنشاء منتج جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string',
            'image'        => 'nullable|string', // تأكد من وجوده إن أردت إدخال الصور يدويًا
        ]);

        $product = Product::create($data);

        return $this->success('تم إنشاء المنتج بنجاح', $product, 201);
    }

    //  تحديث منتج موجود
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'price'        => 'sometimes|required|numeric|min:0',
            'category_id'  => 'sometimes|required|exists:categories,id',
            'description'  => 'nullable|string',
            'image'        => 'nullable|string',
        ]);

        $product->update($data);

        return $this->success('تم تحديث المنتج بنجاح', $product);
    }

    //  حذف منتج
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->success('تم حذف المنتج بنجاح');
    }
}
