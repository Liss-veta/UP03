<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function all()
    {
        return Category::all();
    }

    public function add_category(Request $request)
    {
        $category = $request->input('category');
        DB::table('categories')->insert([
            'category' => $category
        ]);
    }

    public function delete_category($id)
    {
        DB::table('categories')->where('id',$id)->delete();
    }
}
