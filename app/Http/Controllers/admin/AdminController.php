<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CustomerQuestion;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productsCount = Product::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $customerQueryCount  = CustomerQuestion::whereNUll('reply')->count();
        $productCategory1 = Product::where('category_id', 1)->count();
        $productCategory2 = Product::where('category_id', 2)->count();
        $productCategory3 = Product::where('category_id', 3)->count();
        $productCategory4 = Product::where('category_id', 4)->count();
        $productCategory5 = Product::where('category_id', 5)->count();
        return view('admin.dashboard', compact([
            'productsCount', 'customerQueryCount', 'categoryCount', 'userCount', 'productCategory1', 'productCategory2', 'productCategory3', 'productCategory4', 'productCategory5'
        ]));
    }

    public function profile()
    {
        return view('admin.profile');
    }
}
