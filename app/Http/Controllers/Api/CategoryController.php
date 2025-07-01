<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    //  إنشاء تصنيف جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($data);

        return $this->success('Category created successfully', $category, 201);
    }

    //  عرض كل التصنيفات
    public function index()
    {
        \Log::info('Fetching categories by user:', ['user' => auth()->user()]);
        $categories = Category::all();

        return $this->success('Categories retrieved successfully', $categories);
    }

    //  عرض تصنيف محدد
    public function show(Category $category)
    {
        return $this->success('Category retrieved successfully', $category);
    }

    //  تعديل تصنيف
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return $this->success('Category updated successfully', $category);
    }

    //  حذف تصنيف
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success('Category deleted successfully');
    }
}
