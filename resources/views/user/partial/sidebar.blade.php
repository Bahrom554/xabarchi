@foreach($latest as $post)
    @if($loop->index>2)
        @break;
    @endif
    <div class="mb-3" style="max-width: 100%;">
    <!-- Post Article -->
    <div class="card__post card__post-list">
        <div class="image-sm">
            <a href="{{route('upost.show',$post->id)}}">
                <img src="{{asset('storage/static'.$post->file->path.'_500x400.'.$post->file->ext)}}"
                    class="img-fluid" alt="">
            </a>
        </div>


        <div class="card__post__body ">
            <div class="card__post__content">
                <div class="card__post__author-info mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <span class="text-primary">
                                by {{$post->user->name}}
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <span class="text-dark text-capitalize">
                                {{ Carbon\Carbon::parse( $post->updated_at)->toFormattedDateString()}}
                            </span>
                        </li>

                    </ul>
                </div>
                <div class="card__post__title">
                    <h6 style=" height: 60px; overflow: hidden">
                        <a href="{{route('upost.show',$post->id)}}" >
                            {{$post->title}}
                        </a>
                    </h6>
                    <!-- <p class="d-none d-lg-block d-xl-block">
                            Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu iaculis placerat
                            sollicitudin ut est. In fringilla dui dui.
                        </p> -->

                </div>

            </div>


        </div>
    </div>
    </div>
    @endforeach

    <!-- Post Article -->
@if($latest->count()>3)
    <div class="article__entry">
        <div class="article__image">
            <a href="">
                <img src="{{asset('storage/static'.$latest[3]->file->path.'_800x500.'.$latest[3]->file->ext)}}" alt=""
                    class="img-fluid">
            </a>
        </div>
        <div class="article__content">
            <div class="article__category">
                travel
            </div>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <span class="text-primary">
                        by {{$latest[3]->user->name}}
                    </span>
                </li>
                <li class="list-inline-item">
                    <span class="text-dark text-capitalize">
                        {{ Carbon\Carbon::parse( $latest[3]->updated_at)->toFormattedDateString()}}
                    </span>
                </li>

            </ul>
            <h5 style=" word-break: break-all; max-height: 60px; line-height: 20px;  overflow: hidden">
                <a href="{{route('upost.show',$post->id)}}" >
                    {{$latest[3]->title}}
                </a>
            </h5>
            <p style="word-break: break-all; max-height: 80px; line-height: 20px;  overflow: hidden">
                {{$latest[3]->subtitle}}
            </p>
            <a href="{{route('upost.show',$latest[3]->id)}}" class="btn btn-outline-primary mb-4 text-capitalize"> read
                more</a>
        </div>
    </div>
@endif
