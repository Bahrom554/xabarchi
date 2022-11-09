@extends('user.layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <aside class="wrapper__list__article ">
                    <h4 class="border_section">Kun Yangiliklari</h4>

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
                                    <h5 style=" max-height: 75px;line-height: 25px; overflow: hidden;">
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
        <!-- Pagination -->
{{--        <div class="pagination-area">--}}
{{--            <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"--}}
{{--                style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">--}}
{{--                <a href="#">--}}
{{--                    «--}}
{{--                </a>--}}
{{--                <a href="#">--}}
{{--                    1--}}
{{--                </a>--}}
{{--                <a class="active" href="#">--}}
{{--                    2--}}
{{--                </a>--}}
{{--                <a href="#">--}}
{{--                    3--}}
{{--                </a>--}}
{{--                <a href="#">--}}
{{--                    4--}}
{{--                </a>--}}
{{--                <a href="#">--}}
{{--                    5--}}
{{--                </a>--}}

{{--                <a href="#">--}}
{{--                    »--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</section>
@endsection
