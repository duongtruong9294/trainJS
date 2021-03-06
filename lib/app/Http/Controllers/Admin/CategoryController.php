<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
    public function getCate() {
        return view('backend.category');
    }

    public function getCategories() {
        $categories = Category::all();
        return response()->json($categories);
    }
}
