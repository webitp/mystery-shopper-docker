<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function list()
    {
        return Category::all()->load(['offers', 'offers.link']);
    }

    public function get(int $id)
    {
        $category = Category::where('id', '=', $id)->load('offers')->first();
        if ($category) return $category->toArray();
        return abort(404);
    }
}
