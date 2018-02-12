<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
        $products = Product::withTrashed()->with("clients")->get();
        return view('products.list', ['products' => $products]);
    }

    public function indexAll(){
        $products = Product::all();
        return view('products.list', ['products' => $products]);
    }

    public function show(Product $product){

        $product->clients;
        return view('products.show', ['product' => $product]);
    }


    public function create()
    {
        $product = new Product();
        return view('products.edit', ["product" => $product]);
    }

    public function store(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('products.show', [$product->id])->with('status', 'Producto guardado!');
    }

    public function update(Request $request, Product $product){
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect('/products/' . $product->id);
    }

    public function destroy(Product $product){
        try {
            $product->delete();
        } catch (\Exception $e) {
        }
        return redirect()->route('products.index')->with('status', 'Producto eliminado!');
    }

    public function restore(Product $product){
        $product->restore();
    }

    public function forceDelete(Product $product){
        $product->forceDelete();
    }
}
