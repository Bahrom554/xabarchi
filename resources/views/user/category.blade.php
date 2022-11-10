@extends('user.layouts.app')
@section('content')
<section>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <aside class="wrapper__list__article ">
                    <h4 class="border_section">{{$category->name}} </h4>

                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-6">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{route('upost.show',$post->id)}}">
                                        <img src="{{asset('storage/static'.$post->file->path.'_800x600.'.$post->file->ext)}}"
                                            alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <div class="article__category">
                                        travel
                                    </div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                by {{$post->name}}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-dark text-capitalize">
                                                {{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5 style="  max-height: 75px;line-height: 25px; overflow: hidden;">
                                        <a href="{{route('upost.show',$post->id)}}">
                                            {{$post->title}}
                                        </a>
                                    </h5>
                                    <p style=" max-height: 80px;line-height: 20px; overflow: hidden;">
                                        {{$post->subtitle}}
                                    </p>
                                    <a href="{{route('upost.show',$post->id)}}"
                                        class="btn btn-outline-primary mb-4 text-capitalize"> read more</a>
                                </div>
                            </div>
                            <!-- Post Article -->
                        </div>
                        @endforeach
                    </div>

                </aside>

            </div>
            <div class="col-md-4">
                <div class="sidebar-sticky">
                    <aside class="wrapper__list__article ">
                        <h4 class="border_section">Most viewed</h4>
                        <div class="wrapper__list__article-small">
                            @include('user.partial.sidebar')
                        </div>
                    </aside>

                    @include('user.partial.tags')
                    @include('user.partial.advertise')
                    @include('user.partial.newsletter')


                </div>
            </div>
            <div class="clearfix"></div>
        </div>
   @if ($posts->hasPages())
        <div class="row">
            <div class="pagination-area  col-lg-8">
                <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                    style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
        {{-- Previous Page Link --}}
        @if ($posts->onFirstPage())
            <a class="disabled"><span>«</span></a>
        @else
            <a href="{{ $posts->previousPageUrl() }}" rel="prev">«</a>
        @endif

       <span class="d-none d-md-inline">
           @if($posts->currentPage() > 3)
               <a class="hidden-xs" href="{{ $posts->url(1) }}">1</a>
           @endif
           @if($posts->currentPage() > 4)
               <a href="#"><span>...</span></a>
           @endif
           @foreach(range(1, $posts->lastPage()) as $i)
               @if($i >= $posts->currentPage() - 2 && $i <= $posts->currentPage() + 2)
                   @if ($i == $posts->currentPage())
                       <a class="active"><span>{{ $i }}</span></a>
                   @else
                       <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                   @endif
               @endif
           @endforeach
           @if($posts->currentPage() < $posts->lastPage() - 3)
               <a><span>...</span></a>
           @endif
           @if($posts->currentPage() < $posts->lastPage() - 2)
               <a class="hidden-xs"href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage() }}</a>
           @endif
       </span>

        {{-- Next Page Link --}}
        @if ($posts->hasMorePages())
         <a href="{{ $posts->nextPageUrl() }}" rel="next">»</a>
        @else
            <a class="disabled"><span>»</span></a>
        @endif
      </div>
   </div>
 </div>
@endif
    </div>
</section>
@endsection
