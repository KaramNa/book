<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view("category");
    }

    public function store(Request $request){
        $request->validate([
            "category" => "required|unique:categories,name"
        ]);

        Category::create([
            "name" => $request->category
        ]);

        return back()->with("success", "New Category has been added");
    }
}
