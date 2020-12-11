@extends('main')

@section('pageTitle', ' | All Posts')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Posts</h1>
        </div>
        <div class="col-md-3">
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- End of .row-->
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($posts as $post)
                        <tr>
                            <th> {{ $post -> post_id }} </th>
                            <th> {{ $post -> name }} </th>
                            <td> {{ $post -> post_title }} </td>
                            <td> {{ substr( $post -> post_body, 0, 50 ) }} {{ strlen( $post -> post_body ) > 50 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $post -> post_created_at )) }} </td>
                            <td>
                                <a href="{{ route('posts.show', $post -> post_id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('posts.edit', $post -> post_id) }}" class="btn btn-primary btn-sm">Edit</a>
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
            {!! $posts -> links(); !!}
        </div>
    </div>
@endsection