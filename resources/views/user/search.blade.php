@extends('user.layouts.app')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="wrap__search-result">
                    <div class="wrap__search-result-keyword">
                        <h2>
                            Search results for keyword:
                            <span class="text-primary">
                                {{$search}}
                            </span>
                            found in {{$count}} posts.
                        </h2>
                    </div>
                </div>
                <!-- Post Article List -->
                @foreach($posts as $post)
                <div class="card__post card__post-list card__post__transition mt-30">
                    <div class="row ">
                        <div class="col-md-5">
                            <div class="card__post__transition">
                                <a href="{{route('upost.show',$post->id)}}">
                                    @if($post->file)
                                    <img src="{{asset('storage/static'.$post->file->path.'_500x400.'.$post->file->ext)}}"
                                        class="img-fluid w-100" alt="">

                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7 my-auto pl-0">
                            <div class="card__post__body ">
                                <div class="card__post__content  ">
                                    <div class="card__post__category ">
                                        travel
                                    </div>
                                    <div class="card__post__author-info mb-2">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by {{$post->user->name}}
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    {{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}

                                                </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card__post__title">
                                        <h5 style=" max-height: 75px;line-height: 25px; overflow: hidden;">
                                            <a href="{{route('upost.index',$post->id)}}">
                                                {{$post->title}}
                                            </a>
                                        </h5>
                                        <p class="d-none d-lg-block d-xl-block mb-0" style=" max-height: 100px;line-height: 20px; overflow: hidden;">
                                            {{$post->subtitle}}
                                        </p>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
             <div class="mt-4">
                @if( $posts->lastPage()>1)
                <div class="row">
                <div class="pagination-area col-md-8 mx-auto">
                    <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                        style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <a href="{{ $posts->previousPageUrl() }}">«</a>
                        <a href="{{url()->current()}}?page={{$posts->currentPage()}}" class="active " style="margin: 0 20px;">{{$posts->currentPage()}}</a>
                        <a href="{{ $posts->nextPageUrl() }}">»</a>
                    </div>
                </div>
            </div>
                @endif   
              
            </div>
        </div>
</section>
@endsection
