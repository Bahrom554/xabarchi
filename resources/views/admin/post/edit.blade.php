@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('post.update',$post->id)}}">
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
                <input type="file" name="file" onchange="preview()">
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
                        <optgroup label="{{$category->name}}">
                            @foreach($category->subcategories as $subcategory)
                            <option value="{{$subcategory->id}}" @if($subcategory->id==$post->category_id) selected
                                @endif>{{$subcategory->name}}</option>
                            @endforeach
                        </optgroup>
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
<script>
    class MyUploadAdapter {
        // ...
        constructor( loader ) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{route('image.upload')}}', true );
            xhr.setRequestHeader('x-csrf-token','{{csrf_token()}}');
            xhr.responseType = 'json';
        }
        //    ......

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve( {
                    default: response.url
                } );
            } );

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }
        //    ....
        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'file', file );

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send( data );
        }
    }

    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter( loader );
        };
    }


    ClassicEditor
        .create(document.querySelector('#editor'), {
            extraPlugins: [ SimpleUploadAdapterPlugin],

            // ...
        })
        .catch(error => {
            console.error(error);
        });

    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

</script>
@endsection
