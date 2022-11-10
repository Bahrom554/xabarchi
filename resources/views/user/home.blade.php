@extends('user.layouts.app')
@section('content')
<!-- Popular news -->
<section style="margin-top: 0 !important; padding-top: 15px !important;">
    <!-- Popular news  header-->
    <div class="popular__news-header">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-8 ">
                    <div class="card__post-carousel">
                        @if($mains->count())
                        @for($i=0; $i<$mains->count()-2; $i++)
                            <div class="item">
                            <!-- Post Article -->
                            <div class="card__post">
                                <div class="card__post__body">
                                    <a href="{{route('upost.show',$mains[$i]->id)}}">
                                        <img src="{{asset('storage/static'.$mains[$i]->file->path.'_800x600.'.$mains[$i]->file->ext)}}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <div class="card__post__content bg__post-cover" style="padding-bottom: 20px" >
                                        <div class="card__post__category">
                                            {{$mains[$i]->category->name}}
                                        </div>
                                        <div class="card__post__title ">
                                            <h2  style=" max-height: 70px;line-height: 35px; overflow: hidden;"  >
                                                <a  href="{{route('upost.show',$mains[$i]->id)}}"  >
                                                    {{$mains[$i]->title}}
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="card__post__author-info">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    by {{$mains[$i]->user->name}}
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{ Carbon\Carbon::parse( $mains[$i]->updated_at)->toFormattedDateString()}}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                        @endfor
                        @endif
                    </div>
            </div>
            <div class="col-md-4">
                <div class="popular__news-right">
                    @if($mains->count()>2)
                    @for($i=$mains->count()-2; $i<$mains->count(); $i++)  <!-- Post Article -->
                        <div class="card__post ">
                            <div class="card__post__body card__post__transition">
                                <a href="{{route('upost.show',$mains[$i]->id)}}">
                                    <img src="{{asset('storage/static'.$mains[$i]->file->path.'_600x400.'.$mains[$i]->file->ext)}}"
                                        class="img-fluid" alt="">
                                </a>
                                <div class="card__post__content bg__post-cover" style="padding-bottom: 10px">
                                    <div class="card__post__category">
                                        {{$mains[$i]->category->name}}
                                    </div>
                                    <div class="card__post__title">
                                        <h5  style=" max-height: 50px;line-height: 25px; overflow: hidden;" >
                                            <a  href="{{route('upost.show',$mains[$i]->id)}}">
                                                {{$mains[$i]->title}} </a>
                                        </h5>
                                    </div>
                                    <div class="card__post__author-info">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                {{$mains[$i]->user->name}}
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    {{ Carbon\Carbon::parse( $mains[$i]->updated_at)->toFormattedDateString()}}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endfor
                        @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Popular news header-->
    <!-- Popular news carousel -->
    <div class="popular__news-header-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top__news__slider">
                        @foreach($lists as $list)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{route('upost.show',$list->id)}}">
                                        <img src="{{asset('storage/static'.$list->file->path.'_500x400.'.$list->file->ext)}}"
                                            alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary ">
                                                by {{$list->user->name}}
                                            </span>,
                                        </li>

                                        <li class="list-inline-item">
                                            <span>
                                                {{ Carbon\Carbon::parse( $list->updated_at)->toFormattedDateString()}}

                                            </span>
                                        </li>
                                    </ul>
                                    <h5  style=" max-height: 100px;line-height: 20px; overflow: hidden;" >
                                        <a  href="{{route('upost.show',$list->id)}}">
                                            {{$list->title}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news carousel -->
</section>
<!-- End Popular news -->

<!-- Popular news category -->
<section class="pt-0">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">recent post</h4>
                    </div>
                    <div class="row">
{{--                        @if($recents->count())--}}
                        @for($i=0; $i<$recents->count()-4; $i++)<div class="col-sm-12 col-md-6 mb-4">
                            <!-- Post Article -->
                            <div class="card__post ">
                                <div class="card__post__body card__post__transition">
                                    <a href="{{route('upost.show',$recents[$i]->id)}}">
                                        <img src="{{asset('storage/static'.$recents[$i]->file->path.'_600x400.'.$recents[$i]->file->ext)}}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <div class="card__post__content bg__post-cover" style="padding-bottom: 10px">
                                        <div class="card__post__category">
                                            {{$recents[$i]->category->name}}
                                        </div>
                                        <div class="card__post__title">
                                            <h5  style=" max-height: 50px;line-height: 25px; overflow: hidden;">
                                                <a
                                                    href="{{route('upost.show',$recents[$i]->id)}}">{{$recents[$i]->title}}</a>
                                            </h5>
                                        </div>
                                        <div class="card__post__author-info">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">

                                                    by {{$recents[$i]->user->name}}

                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{ Carbon\Carbon::parse( $recents[$i]->updated_at)->toFormattedDateString()}}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    @endfor
{{--                        @endif--}}
                </div>
                <div class="row ">
                    @if($recents->count()>4)
                    @for($i=$recents->count()-4; $i<$recents->count(); $i++)  <div class="col-sm-12 col-md-6">
                        <div class="wrapp__list__article-responsive">
                            <div class="mb-3">
                                <!-- Post Article -->
                                <div class="card__post card__post-list">
                                    <div class="image-sm">
                                        <a href="{{route('upost.show',$recents[$i]->id)}}">
                                            <img src="{{asset('storage/static'.$recents[$i]->file->path.'_500x400.'.$recents[$i]->file->ext)}}"
                                                class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="card__post__body ">
                                        <div class="card__post__content">
                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            by {{$recents[$i]->user->name}}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ Carbon\Carbon::parse( $recents[$i]->updated_at)->toFormattedDateString()}}
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="card__post__title">
                                                <h6  style=" max-height: 80px;line-height: 20px; overflow: hidden;">
                                                    <a href="{{route('upost.show',$recents[$i]->id)}}">
                                                        {{$recents[$i]->title}}
                                                    </a>
                                                </h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                    @endfor
                        @endif
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <aside class="wrapper__list__article">
                <h4 class="border_section">popular post</h4>
                <div class="wrapper__list-number">
                    <!-- List Article -->
                    @foreach($populars as $popular)
                    <div class="card__post__list">
                        <div class="list-number">
                            <span>
                                {{$loop->index+1}}
                            </span>
                        </div>
                        {{--                                category link --}}
                        <a href="#" class="category">
                            {{$popular->category->name}}
                        </a>
                        <ul class="list-inline">
                            <li class="list-inline-item">

                                by {{$popular->user->name}}


                            </li>
                            <li class="list-inline-item">
                                <span>
                                    <i class="fa fa-calendar"></i>
                                    {{ Carbon\Carbon::parse($popular->updated_at)->toFormattedDateString()}}
                                </span>

                            </li>
                            <li class="list-inline-item">
                                <h5  style=" max-height: 60px;line-height: 20px; overflow: hidden;">
                                    <a href="{{route('upost.show',$popular->id)}}">
                                        {{$popular->title}}

                                    </a>
                                </h5>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
    </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">technology</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach($texnos as $tex)
                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{route('upost.show',$tex->id)}}">
                                    <img src="{{asset('storage/static'.$tex->file->path.'_500x400.'.$tex->file->ext)}}"
                                        alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            by {{$tex->user->name}}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>
                                            {{ Carbon\Carbon::parse( $tex->updated_at)->toFormattedDateString()}}
                                        </span>
                                    </li>

                                </ul>
                                <h5  style=" max-height: 100px;line-height: 25px; overflow: hidden;">
                                    <a href="{{route('upost.show',$tex->id)}}">
                                        {{$tex->title}}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->


    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">lifestyle</h4>
                        <div class="row">
                            @foreach($lifes as $post)
                            <div class="mb-4 col-md-6">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="{{route('upost.show',$post->id)}}">
                                            <img src="{{asset('storage/static'.$post->file->path.'_500x400.'.$post->file->ext)}}"
                                                alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    by {{$post->user->name}}
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    {{ Carbon\Carbon::parse($post->updated_at)->toFormattedDateString()}}
                                                </span>
                                            </li>

                                        </ul>
                                        <h5 style=" max-height: 150px;line-height: 25px; overflow: hidden;" >
                                            <a href="{{route('upost.show',$post->id)}}">
                                                {{$post->title}}
                                            </a>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">technology</h4>
                        <div class="wrapp__list__article-responsive">
                            <!-- Post Article List -->
                            @foreach($footers as $footer)
                            <div class="card__post card__post-list card__post__transition mt-30">
                                <div class="row ">
                                    <div class="col-md-5">
                                        <div class="card__post__transition">
                                            <a href="{{route('upost.show',$footer->id)}}">
                                                <img src="{{asset('storage/static'.$footer->file->path.'_500x400.'.$footer->file->ext)}}"
                                                    class="img-fluid w-100" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7  pl-0">
                                        <div class="card__post__body ">
                                            <div class="card__post__content  ">
                                                <div class="card__post__category mt-0 ">
                                                    {{$footer->category->name}}
                                                </div>
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by {{$footer->user->name}}

                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{ Carbon\Carbon::parse($footer->updated_at)->toFormattedDateString()}}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h3 style=" max-height: 90px;line-height: 30px; overflow: hidden;">
                                                        <a href="{{route('upost.show',$footer->id)}}">
                                                            {{$footer->title}}
                                                        </a>
                                                    </h3>
                                                    <p class="d-none d-lg-block d-xl-block mb-0" style=" max-height: 80px;line-height: 20px; overflow: hidden;">
                                                        {{$footer->subtitle}}
                                                    </p>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                Most viewed</h4>
                            <div class="wrapper__list__article-small">
                                @include('user.partial.sidebar')
                            </div>
                        </aside>

                        @include('user.partial.stayconnect')

                        @include('user.partial.tags')

                        @include('user.partial.advertise')

                        @include('user.partial.newsletter')
                    </div>
                </div>
                {{--                <div class="mx-auto">--}}
                {{--                    <!-- Pagination -->--}}
                {{--                    <div class="pagination-area">--}}
                {{--                        <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"--}}
                {{--                             style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">--}}
                {{--                            {{$latest->links()}}--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Popular news category -->
@endsection
