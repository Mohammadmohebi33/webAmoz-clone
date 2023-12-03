<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function back;
use function to_route;
use function view;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $categories = Category::all();
        return view('panel.category.index' , compact('categories'));
    }


    public function show(Category $category)
    {
        return view('panel.category.show' , compact('category'));
    }


    public function store(Request $request)
    {
        Category::query()->create([
            'name' => $request->category,
            'slug' => Str::slug($request->category),
            'parent_id' => $request->has('parent_id')  ? $request->parent_id : null,
        ]);

        return back();
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('category.index')->with('successfully' , 'category deleted successfully');
    }
}
