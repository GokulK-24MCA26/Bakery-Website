<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\categories;

 class HomeController extends Controller
{
    public function index(){
        $categories =categories::all();
        return view("home.index",compact("categories"));
    }
    public function Cakes(){
        
       $query = Product::query();
        if (request('name')) {
            $query->where('name', 'LIKE', '%' . request('name') . '%');
        }
        $cakenames = $query->get();
        $cakes=Product::where('category_id', 1)->get();
        return view("products.cakes", compact("cakes","cakenames"));
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
        $dondests=Product::where('category_id', 5)->get();
        return view("products.donets&desserts", compact("dondests"));
    }
}