<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
        $products = Product::withTrashed()->with("clients")->get();
        return $products;
    }

    public function indexAll(){
        $products = Product::all();
        return $products;
    }

    public function show(Product $product){

        $product->clients;
        return $product;
    }

    public function store(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return response(200);
    }

    public function update(Request $request, Product $product){
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return response(200);
    }

    public function destroy(Product $product){
        try {
            $product->delete();
        } catch (\Exception $e) {
        }
        return response(200);
    }

    public function restore(Product $product){
        $product->restore();
    }

    public function forceDelete(Product $product){
        $product->forceDelete();
    }
}
