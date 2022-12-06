@extends('admin.layouts.app')
@section('content')
<div class="row mt-2">
    <div class="card ">
        @include('admin.layouts.message')
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2 class="mb-2 text-uppercase ">tags</h2>
            <a type="button" href="{{route('tag.create')}}" class="btn btn-primary px-5">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->slug}}</td>
                            <td>
                                <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <a href="{{route('tag.edit',$tag->id)}}" class="text-warning" title="Edit"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <form method="POST" action="{{route('tag.destroy',$tag->id)}}">
                                        @method('delete')
                                        @csrf
                                        <input name="url" hidden value="{{$tags->currentPage()}}">
                                        <a href="#" style="color: red;" onclick="if(confirm('Are sure,You want delete this?')){
                                            event.preventDefault();
                                            this.closest('form').submit();
                                           }
                                            else{
                                            event.preventDefault();}" >
                                            <i class="bi bi-trash-fill"></i></a>
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
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                {{ $tags->links() }}
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
                "width": "50%",
                "targets": 1
            },
            {
                "width": "31%",
                "targets": 2
            },
            {
                "width": "12%",
                "targets": 3
            },
        ],
        "paging": false,
        "order": [0, 'desc'],
        "info":false
    });


</script>
@endsection
