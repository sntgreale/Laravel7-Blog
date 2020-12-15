@extends('main')

@section('pageTitle', ' | Feed')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>Your feed</h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $post -> name}} - {{ $post -> post_title }}</h2>
                        <h5>Published: {{ date('j M, Y', strtotime($post -> post_created_at)) }} </h5>

                        <p>{{ substr($post -> post_body, 0, 250) }} {{ strlen($post -> post_body) > 250 ? '...' : "" }} </p>

                        <a href="{{ route('posts.show', $post -> post_id) }}" class="btn btn-sm btn-outline-primary">View Post</a>

                        <hr>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <h3>Friends Activity</h3>
            <div class="row">
                <div class="card card-body bg-light">
                    <h5>Reposts</h5>
                    <hr>
                    @foreach ($reposts as $repost)
                        <dl class="row">
                            <div class="col-md-4">
                                {{ Html::linkRoute('users.show', substr($repost -> name, 0, 10), [$repost -> repost_user_id], ['class' => 'btn-camp btn btn-sm btn-outline-primary']) }}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn-sm btn btn-outline-dark" disabled> ==> </button>
                            </div>
                            <div class="col-md-6">
                                
                                {{ Html::linkRoute('posts.show', substr($repost -> post_title, 0, 10).'...' , [$repost -> repost_post_id], ['class' => 'btn-camp btn btn-sm btn-outline-primary']) }}
                            </div>
                        </dl>
                    @endforeach
                </div>
            </div>
            <br>

            <div class="row">
                <div class="card card-body bg-light">
                    <h5>Likes</h5>
                    <hr>
                    @foreach ($likes as $like)
                        <dl class="row">
                            <div class="col-md-4">
                                {{ Html::linkRoute('users.show', substr($like -> name, 0, 10) , [$like -> like_user_id], ['class' => 'btn-camp btn btn-sm btn-outline-primary']) }}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn-sm btn btn-outline-dark" disabled> ==> </button>
                            </div>
                            <div class="col-md-6">
                                {{ Html::linkRoute('posts.show', substr($like -> post_title, 0, 10).'...', [$like -> like_post_id], ['class' => 'btn-camp btn btn-sm btn-outline-primary']) }}
                            </div>
                        </dl>
                    @endforeach
                </div>
            </div>
            <br>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="mx-auto">
            {!! $posts -> links(); !!}
        </div>
    </div>
@endsection
