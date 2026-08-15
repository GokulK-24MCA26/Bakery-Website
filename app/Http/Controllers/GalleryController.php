<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    const TAGS = ['products', 'events', 'behind-the-scenes', 'seasonal'];

    public function index()
    {
        $items = Gallery::orderBy('tag')->orderBy('sort_order')->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create', ['tags' => self::TAGS]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'tag'        => 'required|in:' . implode(',', self::TAGS),
            'sort_order' => 'nullable|integer|min:0',
            'image'      => 'required|image|max:3072',
        ]);

        $tagIndex  = str_pad(array_search($request->tag, self::TAGS) + 1, 2, '0', STR_PAD_LEFT);
        $itemIndex = str_pad(Gallery::where('tag', $request->tag)->count() + 1, 2, '0', STR_PAD_LEFT);
        $safeName  = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->title));
        $ext       = $request->file('image')->getClientOriginalExtension();
        $filename  = $tagIndex . $itemIndex . $safeName . '.' . $ext;

        $request->file('image')->storeAs('gallery', $filename, 'public');

        Gallery::create([
            'title'      => $request->title,
            'tag'        => $request->tag,
            'sort_order' => $request->sort_order ?? 0,
            'image'      => 'gallery/' . $filename,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Photo added.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', ['item' => $gallery, 'tags' => self::TAGS]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'tag'        => 'required|in:' . implode(',', self::TAGS),
            'sort_order' => 'nullable|integer|min:0',
            'image'      => 'nullable|image|max:3072',
        ]);

        $data = [
            'title'      => $request->title,
            'tag'        => $request->tag,
            'sort_order' => $request->sort_order ?? $gallery->sort_order,
        ];

        if ($request->hasFile('image')) {
            $tagIndex  = str_pad(array_search($request->tag, self::TAGS) + 1, 2, '0', STR_PAD_LEFT);
            $itemIndex = str_pad($gallery->id, 2, '0', STR_PAD_LEFT);
            $safeName  = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->title));
            $ext       = $request->file('image')->getClientOriginalExtension();
            $filename  = $tagIndex . $itemIndex . $safeName . '.' . $ext;

            $request->file('image')->storeAs('gallery', $filename, 'public');
            $data['image'] = 'gallery/' . $filename;
        }

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Photo updated.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Photo deleted.');
    }

    public function publicIndex()
    {
        $items = Gallery::orderBy('sort_order')->get()->groupBy('tag');
        return view('gallery.index', compact('items'));
    }
}
