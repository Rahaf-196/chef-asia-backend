<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;

class FixImageController extends Controller
{
    public function fix()
    {
        $products = Product::with('category')->get();

        foreach ($products as $product) {
            // مثال: '1.jpg' → نأخذ فقط اسم الصورة
            $filename = basename($product->image);

            // اسم مجلد التصنيف (مثال: 'Drinks')
            $folder = $product->category?->name;

            if ($folder && $filename) {
                // نبني المسار الجديد داخل مجلد التصنيف
                $product->image = "$folder/$filename";
                $product->save();
            }
        }

        return response()->json(['message' => 'Images paths fixed successfully']);
    }
}
