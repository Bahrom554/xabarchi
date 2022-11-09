@extends('admin.layouts.app')
@section('content')
<div class=" mt-2">
    <div class="card ">
        @include('admin.layouts.message')
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2 class="mb-2 text-uppercase ">Messages</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Message Body</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->id}}</td>
                            <td class="text-truncate">
                                <a href="{{route('message.show',$message->id)}}"
                                    style="text-decoration: none">{{$message->body}}</a>
                            </td>
                            <td>
                                <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <form method="POST" action="{{route('message.destroy',$message->id)}}">
                                        @method('delete')
                                        @csrf
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
                            <th>body</th>
                            <th>Delete</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('jscontent')
<script>
    $('#example').dataTable({
        "columnDefs": [{
                "width": "10%",
                "targets": 0
            },
            {
                "width": "80%",
                "targets": 1
            },
            {
                "width": "10%",
                "targets": 2
            },

        ],
        "paging": false,
        "order": [0, 'desc'],

    });

</script>
@endsection
