@extends('main')

@section('pageTitle', '| View Post')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1> {{ $post -> post_title }} </h1>
            <p class="lead"> {{ $post -> post_body }} </p>
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
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.edit', 'Edit', array($post -> post_id), array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['posts.destroy', $post -> post_id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        {{ Html::linkRoute('posts.index', '<< See All Posts', [], ['class' => 'btn btn-secondary btn-block btn-h1-spacing']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="row">
            <div class="col-md-3">
                <h2>Comments</h2>
                <br>
            </div>
        </div>
        <div class="row">
            @foreach ($comments as $comment)
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <p> {{ $comment -> name }} --- {{ date('j M, Y H:i', strtotime( $comment -> comment_created_at )) }} </p>
                    <h5> <strong> {{ $comment -> comment_title }} </strong> </h5>
                    <p> {{ $comment -> comment_body }} </p>
                    <hr>
                </div>
                <div class="col-md-3">
                    <!-- BUTTONS FOR ACTIONS OF COMMENTS ( EDIT / DELETE) -->
                </div>
            @endforeach
        </div>
    </div>

@endsection