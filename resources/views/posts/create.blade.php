@extends('main')

@section('pageTitle', '| Create Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
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
                    {{ Form::textarea('post_body', null, array('class' => 'form-control', 'required' => '')) }}
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