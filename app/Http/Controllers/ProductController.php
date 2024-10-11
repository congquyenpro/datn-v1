<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function edit(Request $request)
    {
        // Xử lý chỉnh sửa sản phẩm
        // Logic chỉnh sửa sản phẩm ở đây

        return response()->json(['message' => 'Sản phẩm đã được chỉnh sửa thành công!']);
    }
}
