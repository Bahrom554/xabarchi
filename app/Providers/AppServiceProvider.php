<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user.layouts.app',function ($view){
            $view->with('categories',Category::where('parent_id',null)->with('subcategories')->take(8)->get());
        });
        view()->composer('user.partial.tags',function ($view){
            $view->with('tags', DB::table('tags')
                ->join('post_tags', 'tags.id', '=', 'post_tags.tag_id')
                ->selectRaw('count(*) as total,name,tag_id')
                ->groupBy('tag_id')
                ->orderBy('total','DESC')->take(15)->get());
        });

        view()->composer('user.partial.sidebar',function ($view){
            $view->with('latest',Post::where('status','1')->orderBy('view_count', 'desc')->take(4)->get());
        });


    }
}
