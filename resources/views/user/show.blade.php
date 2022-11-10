@extends('user.layouts.app')
@section('content')
<section class="pb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 wrap__article-detail-title">
                        <h1 style="word-wrap: break-word">
                            {{$post->title}}
                        </h1>
                        <h3>
                            {{$post->subtitle}}
                        </h3>
                    </div>
                    <div class="col-md-4 pb-2">
                        <div style="background-color: black; height: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- content article detail -->
                <!-- Article Detail -->
                <div class="wrap__article-detail">


                    <div class="wrap__article-detail-info">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <figure class="image-profile">
                                    <img src="{{asset('images/placeholder/logo.jpg')}}" alt="">
                                </figure>
                            </li>
                            <li class="list-inline-item">

                                <span>
                                    by
                                </span>
                                <a href="#">
                                    {{$post->user->name}}
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-dark text-capitalize ml-1">
                                    {{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}
                                </span>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-dark text-capitalize">
                                    in
                                </span>
                                <a href="#">
                                    {{$post->category->name}}
                                </a>
                            </li>
                        </ul>
                    </div>
                   <div class="wrap__article-detail-image mt-4">
                        <figure>
                            <img src="{{asset('storage/static'.$post->file->path.'_800x500.'.$post->file->ext)}}" alt=""
                                class="img-fluid">
                        </figure>
                    </div>
                    <div class="wrap__article-detail-content">
                        <div class="total-views">
                            <div class="total-views-read">
                               {{$post->view_count}}
                                <span>
                                    views
                                </span>
                            </div>
                             <ul class="list-inline">
                                <span class="share">share on:</span>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o facebook" href="#">
                                        <i class="fa fa-facebook-f"></i>
                                        <span>facebook</span>
                                    </a>

                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o twitter" href="#">
                                        <i class="fa fa-twitter"></i>
                                        <span>twitter</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o whatsapp" href="#">
                                        <i class="fa fa-whatsapp"></i>
                                        <span>whatsapp</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o telegram" href="#">
                                        <i class="fa fa-telegram"></i>
                                        <span>telegram</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-linkedin-o linkedin" href="#">
                                        <i class="fa fa-linkedin"></i>
                                        <span>linkedin</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="bodyMsg">
                        {!! $post->body !!}
                        </div>
                    </div>


                </div>
                <!-- end content article detail -->

                <!-- tags -->
                <!-- News Tags -->
                <div class="blog-tags">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-tags">
                            </i>
                        </li>
                        @foreach($post->tags as $tag)
                        <li class="list-inline-item">
                            <a href="{{route('post.tag',$tag->id)}}">
                                #{{$tag->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- end tags-->
                <!-- comment -->
                <!-- Comment  -->
                <div id="comments" class="comments-area">
                    <h3 class="comments-title">{{$post->commentNumber()}} Comments:</h3>

                    <ol class="comment-list">
                        @foreach($post->comments as $comment)
                        <li class="comment">
                            <aside class="comment-body">
                                <div class="comment-meta">
                                    <div class="comment-author vcard">
                                        <img src="{{asset('images/placeholder/80x80.jpg')}}" class="avatar" alt="image">
                                        <b class="fn">{{$comment->author_name}}</b>
                                        <span class="says">says:</span>
                                    </div>

                                    <div class="comment-metadata">
                                        <a href="#">

                                            <span>
                                                {{ Carbon\Carbon::parse( $comment->created_at)->diffForHumans(Carbon\Carbon::now())}}
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="comment-content">
                                    <p>{{$comment->body}}</p>
                                </div>
                            </aside>
                        </li>
                        @endforeach
                    </ol>

                    <div class="comment-respond">
                        <h3 class="comment-reply-title">Comment</h3>
                        <form class="comment-form" method="POST" action="{{route('post.comment',$post->id)}}">
                            @csrf
                            <p class="comment-notes">
                                <span id="email-notes">Your email address will not be published.</span>
                                Required fields are marked
                                <span class="required">*</span>
                            </p>
                            <p class="comment-form-comment">
                                <label for="comment">Comment</label>
                                <textarea name="body" id="comment" cols="45" rows="5" maxlength="65525"
                                    required="required"></textarea>
                            </p>
                            <p class="comment-form-author">
                                <label>Name <span class="required">*</span></label>
                                <input type="text" id="author" name="author_name" required="required">
                            </p>
                            <p class="comment-form-email">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="author_email" >
                            </p>
                            <p class="form-submit">
                                <input type="submit" class="submit" value="Post Comment">
                            </p>
                        </form>
                    </div>
                </div>
                <!-- Comment -->
                <!-- end comment -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="single_navigation-prev text-truncate">
                            @if($posts->count())
                            <a  href="{{route('upost.show',$posts[0]->id)}}">
                                <span>previous post</span>
                                {{$posts[0]->title}}
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single_navigation-next text-left text-md-right text-truncate">
                            @if($posts->count()>1)
                            <a href="{{route('upost.show',$posts[$posts->count()-1]->id)}}">
                                <span>next post</span>
                                {{$posts[$posts->count()-1]->title}}
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="related-article">
                    <h4>
                        you may also like
                    </h4>

                    <div class="article__entry-carousel-three">
                        @foreach($posts as $post)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{route('upost.show',$post->id)}}">
                                        @if($post->file)
                                        <img src="{{asset('storage/static'.$post->file->path.'_800x500.'.$post->file->ext)}}"
                                            alt="" class="img-fluid">
                                        @endif
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
                                                {{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5 style=" max-height: 100px;line-height: 25px; overflow: hidden;">
                                        <a href="{{route('upost.show',$post->id)}}">
                                            {{$post->title}}
                                        </a>
                                    </h5>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="sidebar-sticky">
                    <aside class="wrapper__list__article ">
                        <h4 class="border_section">Most viewed</h4>
                        <div class="wrapper__list__article-small">
                            @include('user.partial.sidebar')
                        </div>
                    </aside>
                    <!-- social media -->
                    @include('user.partial.stayconnect')
                    <!-- End social media -->
                    @include('user.partial.tags')
                    @include('user.partial.newsletter')
                    @include('user.partial.advertise')

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
