<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = categories::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|max:2048',
        ]);

        // $number = categories::count() + 1;
        $data = [$request->name];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        categories::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit(categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, categories $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(categories $category)
    {
        $category->delete();
       return response()->json([
        'success' => true,
        'message' => 'Category deleted.'
    ]);
    }

    public function show(categories $category) {}
}
