@extends('main')

@section('pageTitle', ' | User')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>{{ $user -> name }}</h1>
            @if ((Auth::user() -> id != $user -> id) and (Auth::user() -> is_admin != 1))
                @if( $follow -> count() != 0)
                    @foreach ($follow as $foll)
                        {!! Form::open(['route' => ['follows.destroy', $foll -> follow_id] , 'method' => 'DELETE']) !!}
                            {!! Form::submit('Unfollow', ['class' => 'btn btn-outline-primary']) !!}
                        {!! Form::close() !!}
                    @endforeach
                @else
                    {!! Form::open(['route' => ['follows.store', $user -> id]]) !!}
                        {!! Form::submit('Follow', ['class' => 'btn btn-outline-primary']) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('users.showfollower', $user -> id) }}" class="btn-camp btn btn-outline-primary btn-block">Followers</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.showfollowed', $user -> id) }}" class="btn-camp btn btn-outline-primary btn-block">Followed</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.showreposts', $user -> id) }}" class="btn-camp btn btn-outline-success btn-block">Reposts</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('users.showlikes', $user -> id) }}" class="btn-camp btn btn-outline-danger btn-block">Likes</a>
                </div>
            </div>
        </div>
    </div> <!-- End of .row-->
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </thead>
                <tbody>
                    <tr>
                        <th> {{ $user -> name }} </th>
                        <td> {{ $user -> email }} </td>
                        <td> {{ date('j M, Y', strtotime( $user -> created_at )) }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <h1>Post of the user</h1>
    <hr>
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <h2>{{ $post -> post_title }}</h2>
                    <h5>Published: {{ date('j M, Y', strtotime($post -> post_created_at)) }} </h5>

                    <p>{{ substr($post -> post_body, 0, 250) }} {{ strlen($post -> post_body) > 250 ? '...' : "" }} </p>

                    <a href="{{ route('posts.show', $post -> post_id) }}" class="btn btn-outline-primary">View Post</a>

                    <hr>
                </div>
            </div>
        @endforeach
    <br>
    <div class="row">
        <div class="mx-auto">
            {!! $posts -> links(); !!}
        </div>
    </div>
@endsection