<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\categories;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = categories::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only('category_id', 'name', 'description', 'price');

        if ($request->hasFile('image')) {
            $category    = categories::find($request->category_id);
            $catIndex    = str_pad($category->id, 2, '0', STR_PAD_LEFT);
            $prodIndex   = str_pad(Product::where('category_id', $request->category_id)->count() + 1, 2, '0', STR_PAD_LEFT);
            $safeName    = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->name));
            $ext         = $request->file('image')->getClientOriginalExtension();
            $filename    = $catIndex . $prodIndex . $safeName . '.' . $ext;

            $request->file('image')->storeAs('products', $filename, 'public');
            $data['image'] = 'products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = categories::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only('category_id', 'name', 'description', 'price');

        if ($request->hasFile('image')) {
            $category    = categories::find($request->category_id);
            $catIndex    = str_pad($category->id, 2, '0', STR_PAD_LEFT);
            $prodIndex   = str_pad($product->id, 2, '0', STR_PAD_LEFT);
            $safeName    = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->name));
            $ext         = $request->file('image')->getClientOriginalExtension();
            $filename    = $catIndex . $prodIndex . $safeName . '.' . $ext;

            $request->file('image')->storeAs('products', $filename, 'public');
            $data['image'] = 'products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return  response()->json([
            'success' => true,
            'message' => 'Category deleted.'
            ]);
    }

    public function show(Product $product) {}
}
