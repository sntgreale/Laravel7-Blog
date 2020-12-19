@extends('main')

@section('pageTitle', '| View Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

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
                        <button type="button" class="btn btn-outline-dark" disabled> <strong> Author: </strong> </button>
                    </div>
                    <div class="col-6">
                        {{ Html::linkRoute('users.show', $post -> name , [$post -> id], ['class' => 'btn btn-outline-primary']) }}
                    </div>
                </dl>
                <dl class="row">
                    <div class="col-6" align="right">
                        <button type="button" class="btn btn-outline-dark" disabled> <strong> Created At: </strong> </button>
                    </div>
                    <div class="col-6">
                        <p> {{ date('j M, Y H:i', strtotime( $post -> post_created_at )) }} </p>
                    </div>
                </dl>
                <hr>
                <div class="row">
                    @if ((Auth::user() -> id == $post -> post_user_id) or (Auth::user() -> is_admin == 1))
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.edit', 'Edit', array($post -> post_id), array('class' => 'btn btn-outline-primary btn-block')) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['posts.destroy', $post -> post_id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    @else

                        @if( $repost -> count() != 0)
                            @foreach ($repost as $rep)
                                <div class="col-sm-6">
                                    {!! Form::open(['route' => ['reposts.destroy', $rep -> repost_id] , 'method' => 'DELETE']) !!}
                                        {!! Form::submit('UnRePost', ['class' => 'btn btn-outline-success btn-block']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-6">
                                {!! Form::open(['route' => ['reposts.store', $post -> post_id]]) !!}
                                    {!! Form::submit('RePost', ['class' => 'btn btn-outline-success btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-dark btn-block" disabled>Totales = {{ $repost -> count() }} </button>
                        </div>
                        <div class="col-md-12">
                            <br>
                        </div>
                        @if( $like -> count() != 0)
                            @foreach ($like as $li)
                                <div class="col-sm-6">
                                    {!! Form::open(['route' => ['likes.destroy', $li -> like_id] , 'method' => 'DELETE']) !!}
                                        {!! Form::submit('UnLike', ['class' => 'btn btn-outline-danger btn-block']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-6">
                                {!! Form::open(['route' => ['likes.store', $post -> post_id]]) !!}
                                    {!! Form::submit('Like', ['class' => 'btn btn-outline-danger btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-dark btn-block" disabled>Totales = {{ $like -> count() }} </button>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    @endif
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        {{ Html::linkRoute('posts.index', '<< See All Posts', [], ['class' => 'btn btn-outline-dark btn-block btn-h1-spacing']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    {!! Form::open(['route' => ['comments.store', $post -> post_id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-md-8">
                <h5>Create New Comment</h5>
                <hr>
                    {{ Form::label('comment_title', 'Title:') }}
                    {{ Form::text('comment_title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '20')) }}
                <br>
                    {{ Form::label('comment_body', 'Comment Body:') }}
                    {{ Form::textarea('comment_body', null, array('class' => 'form-control', 'required' => '', 'rows' => '3')) }}
                <br>
                    {{ Form::submit('Add Comment', ['class' => 'btn btn-success']) }}
            </div>
        </div>
        <hr>
    {!! Form::close() !!}

    <div>
        <div class="row">
            <div class="col-md-3">
                <h2>Comments - {{ $comments -> count() }}</h2>
                <br>
            </div>
        </div>
        @foreach ($comments as $comment)
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <h5> <strong> {{ $comment -> comment_title }} </strong> </h5>
                    <p> {{ $comment -> comment_body }} </p>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-light">

                        <dl class="row">
                            <div class="col-6" align="right">
                                <button type="button" class="btn btn-outline-dark" disabled> <strong> Author: </strong> </button>
                            </div>
                            <div class="col-6">
                                {{ Html::linkRoute('users.show', $comment -> name , [$comment -> comment_user_id], ['class' => 'btn btn-outline-primary']) }}
                            </div>
                        </dl>
                        <dl class="row">
                            <div class="col-6" align="right">
                                <button type="button" class="btn btn-outline-dark" disabled> <strong> Created At: </strong> </button>
                            </div>
                            <div class="col-6">
                                <p> {{ date('j M, Y H:i', strtotime( $comment -> comment_created_at )) }} </p>
                            </div>
                        </dl>

                        <hr>
                        <div class="row">
                            @if ((Auth::user() -> id == $comment -> comment_user_id) or (Auth::user() -> is_admin == 1))
                                <div class="col-sm-12">
                                    {!! Form::open(['route' => ['comments.destroy', $comment -> comment_id], 'method' => 'DELETE']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-h1-spacing btn-block']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <hr>
        @endforeach
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
@endsection
