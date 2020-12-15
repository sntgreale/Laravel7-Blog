@extends('main')

@section('pageTitle', ' | All Posts')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Posts</h1>
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
                            <th> <a href="{{ route('users.show', $post -> id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $post -> name }}</a> </th>
                            <th> <a href="{{ route('posts.show', $post -> post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $post -> post_title }}</a> </th>
                            <td> {{ substr( $post -> post_body, 0, 50 ) }} {{ strlen( $post -> post_body ) > 50 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $post -> post_created_at )) }} </td>
                            <td>
                                <a href="{{ route('posts.show', $post -> post_id) }}" class="btn-up btn btn-primary btn-sm btn-block">View</a>
                                <a href="{{ route('posts.edit', $post -> post_id) }}" class="btn-up btn btn-primary btn-sm btn-block">Edit</a>
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