<?php

// app/Http/Controllers/UserProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all categories
        $categories = Category::all();

        // Fetch products based on the selected category
        $categoryId = $request->input('category_id');
        if ($categoryId) {
            $products = Product::where('category_id', $categoryId)->get();
        } else {
            $products = Product::all();
        }

        // Pass the products and categories to the view
        return view('users.products.index', compact('products', 'categories'));
    }
}

