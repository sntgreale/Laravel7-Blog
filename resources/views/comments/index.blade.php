@extends('main')

@section('pageTitle', ' | All Comments')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Comments</h1>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- End of .row-->
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Author</th>
                    <th>Post ID</th>
                    <th>Post Title</th>
                    <th>Comment Title</th>
                    <th>Comment Body</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($comments as $comment)
                        <tr>
                            <th> <a href="{{ route('users.show', $comment -> id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $comment -> name }}</a> </th>
                            <td> {{ $comment -> comment_post_id }} </td>
                            <th> <a href="{{ route('posts.show', $comment -> post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $comment -> post_title }}</a> </th>
                            <td> {{ $comment -> comment_title }} </td>
                            <td> {{ substr( $comment -> comment_body, 0, 40 ) }} {{ strlen( $comment -> comment_body ) > 50 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $comment -> comment_created_at )) }} </td>
                            <td>
                                <a href="{{ route('posts.show', $comment -> comment_post_id) }}" class="btn btn-outline-primary btn-sm">View Post</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mx-auto">
            {!! $comments -> links(); !!}
        </div>
    </div>
@endsection