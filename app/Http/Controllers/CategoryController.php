<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function savecategory(Request $request){
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->save();
        return back()->with("status", "Votre catégorie a été créée avec succès");

    }
    public function deletecategory($id){
        $category = Category::find($id);
        $category->delete();
        return back()->with("status", "Votre catégorie a été supprimée avec succès !!");
    }

    public function editcategory($id){
        $category = Category::find($id);
        return view('admin.editcategory')->with("category", $category);
    }
    public function updatecategory($id, Request $request){
        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
        $category->update();
        return redirect('admin/categories')->with("status", "Votre catégorie a été modifiée avec succès !!");
    }
}
