@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')
<div class="row">
    <div class="offset-md-1 col-md-10">
        <div class="wrap__article-detail">
            <div class="wrap__article-detail-title">
                <h1>
                    {{$post->title}}
                </h1>
                <h3 style="color: gray; font-weight: bold;" >
                    {{$post->subtitle}}
                </h3>
            </div>
            <hr>
            <div class="wrap__article-detail-info"
                style="font-family:Montserrat,sans-serif; text-transform: capitalize; font-weight: 600; font-size: 14px">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <span>
                            By
                        </span>
                        {{--                {{route('user.show',$post->user->id)}}--}}
                        <a href="#" style=" color: red;">
                            {{$post->user->name}}
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <span class="text-dark text-capitalize ml-1">
                            {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString()}}
                        </span>
                    </li>
                    <li class="list-inline-item">
                        <span class="text-dark text-capitalize">
                            in
                        </span>
                        <a href="#" style=" color: red;">
                            {{$post->category->name}}
                        </a>


                    </li>
                </ul>
            </div>

            @if($post->file)
            <div class="wrap__article-detail-image my-4">
                <figure>
                    <img src="{{asset('storage/static'.$post->file->path.'_800x500.'.$post->file->ext)}}" alt=""
                        class="img-fluid">
                </figure>
            </div>
            @endif
            <div class="wrap__article-detail-content my-4 ">
                <div class="bodyMsg">
                    {!! $post->body !!}
                </div>
            </div>


        </div>
        <!-- end content article detail -->

        <!-- tags -->
        <!-- News Tags -->
        <div class="blog-tags mt-2">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <i class="bi bi-tags" style="color: red">
                    </i>
                </li>
                @foreach($post->tags as $tag )
                <li class="list-inline-item" style="border: 1px solid black; ">
                    <a href="#" style="text-decoration:none !important;">
                        #{{$tag->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <form method="POST" action="{{route('post.publish',$post->id)}}">
            @method('PUT')
            @csrf
            <div style="display:flex; align-items:center; justify-content:flex-end;">
                <div style="width:140px; height:80px; display:flex; align-items:center; justify-content:space-between;">
                    <label style=" padding:0; margin:0;font-size:22px;" class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked"
                            @if($post->status) checked @endif >
                    </div>
                </div>
                <a href="{{route('post.edit',$post->id)}}" type="button" class="btn btn-warning py-3 px-5 mx-3">Edit</a>
                <button type="submit" class="btn btn-success py-3 px-5 ">success</button>
            </div>
        </form>
    </div>
</div>

@endsection
