@extends('main')

@section('pageTitle','| Edit Post')

@section('stylesheets')
    
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
            /*
                URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                images_upload_url: 'postAcceptor.php',
                here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
            Note: In modern browsers input[type="file"] is functional without
            even adding it to the DOM, but that might not be the case in some older
            or quirky browsers like IE, so you might want to add it to the DOM
            just in case, and visually hide it. And do not forget do remove it
            once you do not need it anymore.
            */

            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                /*
                    Note: Now we need to register the blob in TinyMCEs image blob
                    registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
                */
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

{!! Form::model($post, ['route' => ['posts.update', $post -> post_id], 'method' => 'PUT']) !!}
    <div class="row">
            <div class="col-md-8">
                {{ Form::label('post_title', 'Title:') }}
                {{ Form::text('post_title', null, ['class' => 'form-control']) }}

                {{ Form::label('post_body', 'Body:', ['class' => 'form-spacing-top']) }}
                {!! Form::textarea('post_body', null, array('class' => 'form-control')) !!}

                {{ Form::label('post_category_id', 'Category: ') }}
                <select class="form-control" name="post_category_id">
                    @foreach ($categories as $category)
                        @if($category -> category_id == $post -> post_category_id)
                            <option value="{{ $category -> category_id }}" selected>{{ $category -> category_name }} </option>
                        @else
                            <option value="{{ $category -> category_id }}">{{ $category -> category_name }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <div class="card card-body bg-light">
                    <dl class="row">
                        <div class="col-6" align="right">
                            <p> <strong> Author: </strong> </p>
                        </div>
                        <div class="col-6">
                            <p> {{ $post -> name }} </p>
                        </div>
                    </dl>
                    <dl class="row">
                        <div class="col-6" align="right">
                            <p> <strong> Created At: </strong> </p>
                        </div>
                        <div class="col-6">
                            <p> {{ date('j M, Y H:i', strtotime( $post -> post_created_at )) }} </p>
                        </div>
                    </dl>
                    <hr>
                    <div class="row">
                        @if ((Auth::user() -> id == $post -> post_user_id) or (Auth::user() -> is_admin == 1))
                            <div class="col-sm-6">
                                {!! Html::linkRoute('posts.show', 'Cancel', array($post -> post_id), array('class' => 'btn btn-danger btn-block')) !!}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
{!! Form::close() !!}

@endsection