<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{ 
    public function index()
    {
        $products = Product::all();        
        return response()->json([
            "results" => $products
        ], Response::HTTP_OK);
        // return view('welcome', compact('products'));
    }    
    
    public function store(Request $request)
    {
        // validamos los datos
        $request->validate([
            "description" => "required|string",
            "stock" => "required|numeric|min:0",
            "category_id" => "required"
        ]);
        $category = Category::findOrFail($request->category_id);
        $product = $category->products()->create([
            'description' => $request->description,
            'stock' => $request->stock,
        ]);
        //devolvemos una rpta
        return response()->json([
            "result" => $product
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
       $product = Product::find($id);
        return response()->json([
            "result" => $product->categories()
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            "description" => "required|string",
            "stock" => "required|numeric|min:0",
            "category_id" => "required"
        ]);
        $category = Category::findOrFail($request->category_id);
        $product = $category->products()->where('id', $product_id)->update([
            'description' => $request->description,
            'stock' => $request->stock,
        ]);
        return response()->json([
            "message" => "¡Product Updated!",
            "result" => $product
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json([
            "message" => "¡Product deleted!"            
        ], Response::HTTP_OK);
        
    }
}