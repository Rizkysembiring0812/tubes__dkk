<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(15);
        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::allCategoryNames();
        return view('admin.product.create')->with(
            [
                'categories' => $categories,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'sometimes|min:3',
            'price' => 'required',
            'status' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title),
                'image' => '/images/products/' . $request->image,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discount' => $request->discount,
                'user_id' => auth()->id(),
                'status' => $request->status,
            ]);
        });

        Alert::toast('Produk Berhasil ditambahkan!', 'success');
        return redirect(route('product.index'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::allCategoryNames();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'sometimes|min:3',
            'price' => 'required',
            'status' => 'required'
        ]);

        DB::transaction(function () use ($request, $id) {
            $product = Product::find($id);
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title),
                'image' => '/images/products/' . $request->image,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discount' => $request->discount,
                'user_id' => auth()->id(),
                'status' => $request->status,
            ]);
        });

        Alert::toast('Berhasil di Update!', 'success');
        return redirect(route('product.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Alert::toast('Berhasil Dihapus!', 'success');
        return redirect()->route('product.index');
    }

    private function productSave($product, $request)
    {
        $product->user_id = auth()->user()->id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->subCategory = $request->subCategory;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->product_code = Str::upper(Str::random(6));

        if ($request->warranty) {
            $product->warranty = $request->warranty;
        }
        if ($request->color) {
            $product->color = $request->color;
        }
        if ($request->size) {
            $product->size = $request->size;
        }
        if ($request->brand) {
            $product->brand = $request->brand;
        }
        $product->onSale = $request->onSale ? 1 : 0;
        $product->live = $request->live ? 1 : 0;

        if ($product->save()) {
            return true;
        }
        return false;
    }

    private function productUpdate($product, $request)
    {
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->subCategory = $request->subCategory;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;

        if ($request->warranty) {
            $product->warranty = $request->warranty;
        }
        if ($request->color) {
            $product->color = $request->color;
        }
        if ($request->size) {
            $product->size = $request->size;
        }
        if ($request->brand) {
            $product->brand = $request->brand;
        }

        $product->onSale = $request->onSale ? 1 : 0;
        $product->live = $request->live ? 1 : 0;

        if ($product->save()) {
            return true;
        }
        return false;
    }
}
