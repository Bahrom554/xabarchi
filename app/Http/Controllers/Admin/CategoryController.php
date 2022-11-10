<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{




    public function index(Request $request)
    {
        $query = QueryBuilder::for(Category::class);
        $query->allowedAppends(!empty($request->append) ? explode(',', $request->get('append')) : []);
        $query->allowedIncludes(!empty($request->include) ? explode(',', $request->get('include')) : []);
        $query->orderBy('id', 'DESC');
        $categories = $query->paginate(30);

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|unique:categories',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);
        Category::create($request->only('name', 'slug', 'parent_id'));
        return redirect(route('category.index'))->with('message', 'created successfully');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.category.edit', compact('category', 'categories','page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'slug' => 'string|max:100|unique:categories,slug,' . $id,
            'parent_id' => 'nullable|integer|exists:categories,id'

        ]);
        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'slug', 'parent_id'));
        return redirect(route('category.index').'/'.$request->page)->with('message', 'updated success');
    }


    public function destroy(Request $request , Category $category)
    {
        $category->delete();
        return  redirect(route('category.index').'?page='.$request->url)->with('message', 'deleted');
    }

    public function search(Request $request)
    {
        
         if ($value = $request->get('search')) {
            $categories = Category::where('name', 'like', '%' . $value . '%')->get();
            return response()->json([
                'view' => view('admin.category.table', compact('categories'))->render()]);

        } else {
            $categories = Category::where('id', '<', -1)->get();
            return response()->json([
                'view' => view('admin.category.table', compact('categories'))->render()]);
        }
    }
}
