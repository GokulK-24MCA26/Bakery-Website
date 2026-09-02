<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\categories;
use App\Models\Gallery;
 class HomeController extends Controller
{
    public function index(){
        $categories =categories::all();
        $featuredProducts = Product::withCount('orders')
                ->orderByDesc('orders_count')
                ->take(4)
                ->get();
        $galleryImages = Gallery::latest()->take(6)->get();
        return view("home.index",compact("categories","featuredProducts","galleryImages"));
    }
    public function Cakes(){

       $query = Product::where('category_id', 1);
        if (request('name')) {
            $query->where('name', 'LIKE', '%' . request('name') . '%');
        }
        $cakes = $query->get();
        return view("products.cakes", compact("cakes"));
    }
    public function CupCakes(){
        $cupcakes=Product::where('category_id', 2)->get();
        return view("products.cupcakes", compact("cupcakes"));
    }
    public function Cookies(){
        $cookies=Product::where('category_id', 3)->get();
        return view("products.cookies", compact("cookies"));
    }
    public function Breads(){
        $breads=Product::where('category_id', 4)->get();
        return view("products.breads", compact("breads"));
    }
    public function DonetsDeserts(){
        $donuts=Product::where('category_id', 5)->get();
        return view("products.donuts-desserts", compact("donuts"));
    }

    /**
     * All Products — premium unified listing
     * Route: GET /products
     */
    public function allProducts(){
        $categories = categories::withCount('products')->orderBy('name')->get();
        // Also fetch all products with category eager loaded, ordered by latest
        $products = Product::with('category')->latest()->get();

        // Map category slug => route for card links
        $categoryRoutes = [
            'cakes'             => 'products.cakes',
            'cupcakes'          => 'products.cupcakes',
            'cookies'           => 'products.cookies',
            'breads'            => 'products.breads',
            'donuts & desserts' => 'products.donuts',
            'donuts'            => 'products.donuts',
        ];

        return view('products.index', compact('categories','products','categoryRoutes'));
    }
}