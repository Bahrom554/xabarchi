{{--delete modal--}}
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delform" method="post" action="{{route('driver.destroy',$driver->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <div class="modal-header">
                    <h2 class="modal-title" id="deldrive">{{$driver->driver}}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Chindanxam ushbu m'alumotlarni o'chirmoqchimisz?</p>

                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
