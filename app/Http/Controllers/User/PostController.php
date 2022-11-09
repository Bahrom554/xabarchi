<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\UseCases\FileService;
use App\UseCases\PostService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{


    public function index()
    {
        $mains = Post::where('type', 1)->common()->take(7)->get();
        $lists = Post::where('type', 2)->common()->take(15)->get();
        $recents = Post::where('type', 3)->common()->take(6)->get();
        $populars = Post::where('type', 4)->common()->take(4)->get();
        $texnos = Post::where('type', 5)->common()->take(8)->get();
        $lifes = Post::where('type', 6)->common()->take(6)->get();
        $footers = Post::where('type', 7)->common()->take(4)->get();
        return view('user.home', compact('mains', 'lists', 'recents', 'populars', 'texnos', 'lifes', 'footers'));
    }


    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $posts = Post::search($request->search)->with('user', 'file');
        $count = $posts->count();
        $posts = $posts->where('status','1')->whereNotNull('file_id')->paginate(8);
        $search = $request->search;
        return view('user.search', compact('posts', 'search', 'count'));
    }


    public function show(Post $post)
    {
        $posts = $this->sameInTag($post);
        $post->increment('view_count');
        return view('user.show', compact('post', 'posts'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()->where('status','1')->whereNotNull('file_id')->with('user', 'file')->latestFirst()->paginate(8);
        return view('user.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('status','1')->whereNotNull('file_id')->with('user', 'file')->latestFirst()->paginate(8);
        return view('user.tag', compact('posts', 'tag'));
    }
    public function today(){
        $posts = Post::where('status','1')->whereNotNull('file_id')->where('created_at',Carbon::now())->with('user','file')->latestFirst()->paginate(8);
        return view('user.tag', compact('posts'));
    }
    //    public function slug($slug)
    //    {
    //        $post = Post::where('slug', $slug)->orderBy('date', 'desc')->firstOrFail();
    //        return view('pages.post', compact('post'));
    //    }

    protected function sameInTag(Post $post)
    {
        //        $query = DB::table('posts')->join('post_tags', 'posts.id', '=', 'post_tags.post_id');
        //        foreach ($post->tags as $tag) {
        //            $query->select('posts.id')->orWhere('tag_id', $tag->id);
        //        }
        //        $posts = $query->where('posts.id', '<>', $post->id)->take(15)->get();
        //         if( $posts->count()<4){
        return Post::where('category_id', $post->category->id)->latestFirst()->where('status','1')->whereNotNull('file_id')->take(15)->get();
        //         }


        //        return $posts;
    }
}
