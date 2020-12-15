@extends('main')

@section('pageTitle', ' | All Likes')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Likes</h1>
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
                    <th>Author Name</th>
                    <th>Author Email</th>
                    <th>Post ID</th>
                    <th>Post Title</th>
                    <th>Post Body</th>
                    <th>Like Created At</th>
                </thead>
                <tbody>

                    @foreach ($likes as $like)
                        <tr>
                            <th> <a href="{{ route('users.show', $like -> like_user_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $like -> name }}</a> </th>
                            <td> {{ $like -> email }} </td>
                            <td> {{ $like -> like_post_id }} </td>
                            <th> <a href="{{ route('posts.show', $like -> like_post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $like -> post_title }}</a> </th>
                            <td> {{ substr( $like -> post_body, 0, 50 ) }} {{ strlen( $like -> post_body ) > 50 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $like -> like_created_at )) }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mx-auto">
            {!! $likes -> links(); !!}
        </div>
    </div>
@endsection