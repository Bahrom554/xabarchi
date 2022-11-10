@extends('admin.layouts.app')
@section('content')
<div  class=" mt-2">
    <div class="card ">
        @include('admin.layouts.message')
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2 class="mb-2 text-uppercase ">Categories</h2>
            <a type="button" href="{{route('category.create')}}" class="btn btn-primary px-5 ">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="for_search">
                <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id}}</td>
                            <td class="text-truncate">{{$category->name}}</td>
                            <td class="text-truncate">{{$category->slug}}</td>
                            <td class="text-truncate">@if($category->category) {{$category->category->name}}@endif </td>
                            <td>
                                <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <a href="{{route('category.edit',$category->id)}}" class="text-warning"
                                        title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <form method="POST" action="{{route('category.destroy',$category->id)}}">
                                        @method('delete')
                                        @csrf
                                        <input name="url" hidden value="{{$categories->currentPage()}}">
                                        <a href="#" style="color: red;" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="bi bi-trash-fill"></i></a>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('jscontent')

<script>
    $('#example').dataTable({
        "columnDefs": [{
                "width": "5%",
                "targets": 0
            },
            {
                "width": "30%",
                "targets": 1
            },
            {
                "width": "30%",
                "targets": 2
            },
            {
                "width": "25%",
                "targets": 3
            },
            {
                "width": "10%",
                "targets": 4
            },

        ],
        "paging": false,
        "order": [0, 'desc'],
        "info":false

    });


</script>
@endsection
