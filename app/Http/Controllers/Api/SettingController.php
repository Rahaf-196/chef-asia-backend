<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class SettingController extends Controller
{
    use ApiResponseTrait;

    // عرض جميع الإعدادات
    public function index()
    {
        $settings = Setting::all();
        return $this->success('تم عرض الإعدادات بنجاح', $settings);
    }

    // إنشاء إعداد جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'key'   => 'required|string|unique:settings,key',
            'value' => 'required|string',
        ]);

        $setting = Setting::create($data);
        return $this->success('تم إنشاء الإعداد بنجاح', $setting, 201);
    }

    // عرض إعداد واحد
    public function show(Setting $setting)
    {
        return $this->success('تم عرض الإعداد بنجاح', $setting);
    }

    // تحديث إعداد
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'key'   => 'sometimes|required|string|unique:settings,key,' . $setting->id,
            'value' => 'sometimes|required|string',
        ]);

        $setting->update($data);
        return $this->success('تم تحديث الإعداد بنجاح', $setting);
    }

    // حذف الإعداد
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return $this->success('تم حذف الإعداد بنجاح');
    }
}
