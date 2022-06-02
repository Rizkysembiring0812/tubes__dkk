<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::get();
        return view('shop.index')->with([
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    public function show($id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->with('category')->first();

        return view('shop.show')->with([
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function catalog(Request $request)
    {
        $categories = Category::all();
        if ($request) {
            $keyword = $request->search;
            $products = Product::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->paginate(10);
            return view('shop.category')->with([
                'keyword' => $keyword,
                'categories' => $categories,
                'products' => $products,
            ]);
        } else {
            $products = Product::all();
            return view('shop.catalog')->with([
                'categories' => $categories,
                'products' => $products
            ]);
        }
    }

    public function catalogCategory($id)
    {
        $categories = Category::all();
        $category = Category::where('id', $id)->first();
        $products = Product::where('category_id', $category->id)->paginate(10);
        return view('shop.category')->with([
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }
}
