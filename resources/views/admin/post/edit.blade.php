@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row my-2">
        <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('post.index')}}"><i
                    class="bi bi-chevron-left"></i></a></div>
        <h2 class="col col-6" style="text-align: center">Edit Post</h2>
    </div>
    <div class="card border border-1">
        <div class="card-body row">
            <div class="mb-2 px-4">
                <label class="form-label" style="font-size:22px;">Title</label>
                <input type="text" class="form-control" name="title" value="{{old('title',$post->title)}}" required>
            </div>
            <div class="col-md-6">
                <input type="file" name="file" onchange="preview()" >
                <img id="frame"
                    src="@if($post->file){{asset('storage/static'.$post->file->path.'.'.$post->file->ext)}}@endif"
                    style="max-height:300px; max-width: 100%;" />
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">SubTitle</label>
                    <input type="text" class="form-control" name="subtitle" value="{{old('subtitle',$post->subtitle)}}"
                        placeholder="Post Slug" required>
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Types</label>
                    <select class="single-select" name="type" required>
                        <option value="1" @if($post->type==1) selected @endif>maincarusel</option>
                        <option value="2" @if($post->type==2) selected @endif>listCarusel</option>
                        <option value="3" @if($post->type==3) selected @endif>recent</option>
                        <option value="4" @if($post->type==4) selected @endif>popular</option>
                        <option value="5" @if($post->type==5) selected @endif>texnologies</option>
                        <option value="6" @if($post->type==6) selected @endif>lifestyle</option>
                        <option value="7" @if($post->type==7) selected @endif>footer</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Categories</label>
                    <select name="category_id" class="single-select" id="category">
                        @foreach($categories as $category)
                            @if($category->$subcategories->count())
                        <optgroup label="{{$category->name}}">
                            @foreach($category->subcategories as $subcategory)
                            <option value="{{$subcategory->id}}" @if($subcategory->id==$post->category_id) selected
                                @endif>{{$subcategory->name}}</option>
                            @endforeach
                        </optgroup>
                            @else
                                <option value="{{$category->id}}" @if($subcategory->id==$post->category_id) selected
                                    @endif>{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    {{--                        <select class="single-select" name="category_id"  required>--}}
                    {{--                            @foreach($categories as $category)--}}
                    {{--                                <option value="{{$category->id}}"
                    @if($category->id==$post->category_id) selected @endif >{{$category->name}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Tags</label>
                    <select class="multiple-select" name="tags[]" data-placeholder="Choose anything" multiple="multiple"
                        required>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}" @if(in_array($tag->id,$ids)) selected @endif >{{$tag->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;"> Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{old('slug',$post->slug)}}">
                </div>

            </div>


        </div>
    </div>
    <label class="form-label" style="font-size:22px;">Post content</label>
    <textarea id="editor" name="body" required>  {{old('body',$post->body)}}</textarea>
    <div style="display:flex; align-items:center; justify-content:flex-end;margin-top: 4px ">
        <button type="submit" class="btn btn-success py-3 px-5 ">Update</button>
    </div>
</form>

@endsection
@section('jscontent')
@include('admin.layouts.ckeditor')
<script>

    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

</script>
@endsection
