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
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                <br>
                    {{ Form::label('body', 'Post Body:') }}
                    {{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '')) }}
                <br>
                    {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block')) }}
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@endsection