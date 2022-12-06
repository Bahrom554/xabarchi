<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\UseCases\FileService;
use App\UseCases\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    private $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $query = QueryBuilder::for(Post::class);
        $query->allowedSorts($request->sort);
        $query->latestFirst();
        $posts = $query->paginate(30);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $tags = Tag::all();
        $categories = Category::where('parent_id', null)->with('subcategories')->get();
        return view('admin.post.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function store(PostCreateRequest $request)
    {
        $post = $this->service->create($request);
        return view('admin.post.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Post $post)
    {

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
//        $tags = Tag::all();
//        $tag_ids=DB::table('post_tags')->select('tag_id')->where('post_id',$post->id)->get();
        $tags=$post->tags()->get();

        $ids=[];
        foreach ($tags as $tag){
         $ids[]=$tag->id;
        }

        $categories = Category::where('parent_id', null)->with('subcategories')->get();
        return view('admin.post.edit', compact('post', 'tags', 'categories','ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(PostEditRequest $request, Post $post)
    {
        $this->service->edit($request, $post);
        return view('admin.post.show', compact('post'))->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request ,Post $post)
    {

        $this->service->remove($post);
        return redirect(route('post.index').'?page='.$request->url)->with('message', 'deleted');
    }

    public function publish(Request $request, Post $post)
    {
        $request['status'] = $request->has('status') ?  1 : 0;
        $post->update($request->only('status'));
        return redirect(route('post.index'))->with('message', 'success');
    }

    public function search(Request $request)
    {
        if ($value = $request->get('search')) {
            $posts = Post::where('title', 'like', '%' . $value . '%')
                         ->orWhere('subtitle', 'like', '%' . $value . '%')
                         ->orWhere('id',$value)
                           ->get();
            return response()->json([
                'posts' => $posts
            ]);

        }
    }
}
