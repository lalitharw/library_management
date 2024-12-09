<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "image_url" => "required"
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->image_url = $request->image_url;
        $category->save();

        return redirect()->back();
    }
}
