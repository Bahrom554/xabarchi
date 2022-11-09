@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')
<div class="row my-2">
    <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('message.index')}}"><i
                class="bi bi-chevron-left"></i></a></div>
    <h2 class="col col-6" style="text-align: center">Message</h2>
</div>
<div class="row">
    <div class="offset-md-1 col-md-10">
        <div class="wrap__article-detail-info"
            style="font-family:Montserrat,sans-serif; text-transform: capitalize; font-weight: 600; font-size: 14px">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <span>
                        By
                    </span>
                    {{--                {{route('user.show',$post->user->id)}}--}}
                    <span style=" color: red;">
                        {{$message->name?? "Name"}}
                    </span>
                </li>
                <li class="list-inline-item">
                    <span class="text-dark text-capitalize ml-1">
                        {{ Carbon\Carbon::parse($message->created_at)->toFormattedDateString()}}
                    </span>
                </li>
                <li class="list-inline-item">
                    <span class="text-dark text-capitalize">
                        in
                    </span>
                    <span style=" color: red;">
                        {{$message->subject?? "Subject"}}
                    </span>


                </li>
            </ul>
        </div>
        <div class="wrap__article-detail-content ">
            <div class="bodyMsg">
                {{ $message->body}}
            </div>
        </div>



    </div>
</div>

@endsection
