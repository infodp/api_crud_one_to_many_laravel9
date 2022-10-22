<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categorys = Category::all();
        return response()->json([
            "results" => $categorys
        ], Response::HTTP_OK);
    }
        
    public function store(Request $request)
    {
        //validamos los datos
        $request->validate([
            "description" => "required"
        ]);
        //damos de alta en la DB
        $category = Category::create([
            "description" => $request->description
        ]);
        //devolvemos una rpta
        return response()->json([
            "result" => $category
        ], Response::HTTP_OK);
    }
    
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }
    
    public function update(Request $request, $id)
    {
        //validamos los datos
        $request->validate([
            'description' => 'required'
        ]);
        //actualizamos en la DB
        $category = Category::find($id);
        $category->description = $request->description;
        $category->save();
        //devolvemos una rpta
        return response()->json([
            "result" => $category
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        //devolvemos una rpta
        return response()->json([
            "result" => "Category deleted"
        ], Response::HTTP_OK);
    }
}