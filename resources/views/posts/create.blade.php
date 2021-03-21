@extends('main')

@section('pageTitle', '| Create Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    <script src="https://cdn.tiny.cloud/1/4gyc8b6cfiole69cunjv2imjwnnebidexdpvp1uex613axqx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advcode casechange  linkchecker autolink lists checklist media mediaembed pageembed powerpaste table advtable tinymcespellchecker image',
            toolbar: ' undo redo | cut copy paste | casechange | checklist | code | permanentpen | table | image',
            toolbar_mode: 'floating',

            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
                },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>

@endsection

@section('content')
    {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Create New Post</h1>
                <hr>
                    {{ Form::label('post_title', 'Title:') }}
                    {{ Form::text('post_title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                <br>
                    {{ Form::label('post_body', 'Post Body:') }}
                    {!! Form::textarea('post_body', null, array('class' => 'form-control')) !!}
                <br>
                    {{ Form::label('post_category_id', 'Category: ') }}
                    <select class="form-control" name="post_category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category -> category_id }}">{{ $category -> category_name }} </option>
                        @endforeach
                    </select>
                <br>
                    {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block')) }}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@endsection