@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('category.update',$category->id)}}">
    @method('PUT')
    @csrf
    <div class="row">
        <div style="font-size: 40px" class="col-3"><a href="{{route('category.index')}}"><i
                    class="bi bi-chevron-left"></i></a></div>
        <h2 class="col col-6" style="text-align: center">Edit Category</h2>
        <div class="card border border-1 p-4 mt-4 offset-md-3 col-md-6">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;">Parent Category</label>
                    <select name="parent_id" class="single-select" id="category">
                        <option></option>
                        @foreach($categories as $pcategory)
                        <option value="{{$pcategory->id}}" @if($category->parent_id==$pcategory->id) selected
                            @endif>{{$pcategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;">Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name', $category->name)}}"
                        placeholder="Post Slug" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;"> Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{old('slug', $category->slug)}}"
                        required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-3 px-5 ">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection