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
                            <th> {{ $comment -> name }} </th>
                            <td> {{ $comment -> comment_post_id }} </td>
                            <td> {{ $comment -> post_title }} </td>
                            <td> {{ $comment -> comment_title }} </td>
                            <td> {{ substr( $comment -> comment_body, 0, 50 ) }} {{ strlen( $comment -> comment_body ) > 30 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $comment -> comment_created_at )) }} </td>
                            <td>
                                <a href="{{ route('posts.show', $comment -> comment_id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('posts.edit', $comment -> comment_id) }}" class="btn btn-primary btn-sm">Edit</a>
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