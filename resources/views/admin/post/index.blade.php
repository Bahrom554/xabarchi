@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.message')

<div class="d-flex align-items-center justify-content-between px-3">
    <h2 class="mb-2 text-uppercase">Posts</h2>
    <a type="button" href="{{route('post.create')}}" class="btn btn-primary px-5">Create</a>
</div>
<div class="card p-1">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width: 100%; table-layout: fixed;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th class=" d-none d-md-table-cell">Subtitle</th>
                        <th class=" d-none d-lg-table-cell">Published At</th>
                        <th class=" d-none d-md-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td class="text-truncate">{{$post->title}}</td>
                        <td class="text-truncate d-none d-md-table-cell">{{$post->subtitle}}</td>
                        <td class="text-truncate d-none d-lg-table-cell">{{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}
                        </td>
                        <td class="text-truncate d-none d-md-table-cell">{{$post->status0}}</td>


                        <td>
                            <div class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                <a href="{{route('post.show',$post->id)}}" class="text-primary" title="Views"><i
                                        class="bi bi-eye-fill"></i></a>
                                <a href="{{route('post.edit',$post->id)}}" class="text-warning" title="Edit"><i
                                        class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{route('post.destroy',$post->id)}}">
                                    @method('delete')
                                    @csrf
                                    <input name="url" hidden value="{{$posts->currentPage()}}">
                                    <a href="#" style="color: red;" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="bi bi-trash-fill"></i></a>
                                </form>
                            </div>
                        </td>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th class=" d-none d-md-table-cell">Subtitle</th>
                        <th class=" d-none d-lg-table-cell">Published At</th>
                        <th class=" d-none d-md-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="d-flex align-items-center justify-content-end">
            {{ $posts->links() }}
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
                "width": "45%",
                "targets": 1
            },
            {
                "width": "30%",
                "targets": 2
            },
            {
                "width": "10%",
                "targets": 3
            },
            {
                "width": "3%",
                "targets": 4
            },
            {
                "width": "7%",
                "targets": 5
            },
        ],
        "paging": false,
        "order": [0, 'desc'],
        "info":false
    });


</script>
@endsection
