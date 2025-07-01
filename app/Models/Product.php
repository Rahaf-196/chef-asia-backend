<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // السماح بملء هذه الحقول عند إنشاء المنتج
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image'
    ];


    // علاقة المنتج بالتصنيف
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // تحويل اسم الصورة إلى رابط URL كامل
  public function getImageAttribute($value)
{
    if (str_starts_with($value, 'http')) {
        return $value;
    }

    // توليد رابط مباشر من مجلد public/images/
    return asset($value);  // مثال: images/Appetizers1.jpeg
}

}