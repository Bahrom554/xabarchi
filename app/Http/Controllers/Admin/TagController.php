<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class TagController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $query = QueryBuilder::for(Tag::class);
        if (!empty($request->get('search'))) {
            $query->where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('slug', 'like', '%' . $request->get('search') . '%');
        }
        $query->allowedAppends(!empty($request->append) ? explode(',', $request->get('append')) : []);
        $query->allowedIncludes(!empty($request->include) ? explode(',', $request->get('include')) : []);
        $query->orderBy('id', 'DESC');
        $tags = $query->paginate(30);

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */


    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:100|unique:tags'
        ]);
        Tag::create($request->only('name', 'slug'));
        return redirect()->route('tag.index')->with('message', 'created successfully');
    }


    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {

        $request->validate([

            'name' => 'string|max:255',
            'slug' => 'string|max:100|unique:tags,slug,' . $id,

        ]);
        $tag = Tag::findOrFail($id);
        $tag->update($request->only('name', 'slug'));
        return redirect(route('tag.index'))->with('message', 'updated success');
    }

    /**
     * @param $id
     * @return string
     */
    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();
        return  redirect(route('tag.index').'?page='.$request->url)->with('message', 'deleted');
    }

    public function search(Request $request)
    {
        if ($value = $request->get('search')) {
            $tags = Tag::where('name', 'like', '%' . $value . '%')->orWhere('id',$value)->get();
            return response()->json([
                'view' => view('admin.tag.table', compact('tags'))->render()
            ]);

        } else {
            $tags = Tag::where('id', '<', -1)->get();
            return response()->json([
                'view' => view('admin.tag.table', compact('tags'))->render()
            ]);
        }
    }
}
