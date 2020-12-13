@extends('main')

@section('pageTitle', ' | User')

@section('content')
    <div class="row">
        <div class="col-md-11">
            <h1>User</h1>
            <a href="" class="btn btn-primary">Follow</a>
        </div>
    </div> <!-- End of .row-->
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </thead>
                <tbody>
                    <tr>
                        <th> {{ $user -> id }} </th>
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

                    <a href="{{ route('posts.show', $post -> post_id) }}" class="btn btn-primary">View Post</a>

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