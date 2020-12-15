@extends('main')

@section('pageTitle', ' | All Likes of User')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Likes of:  </h1>
        </div>
        <div class="col-md-9"></div>
    </div> <!-- End of .row-->
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('users.show', $user -> id) }}" class="btn-camp btn btn-outline-primary btn-block">{{ $user -> name }}</a>
            <br>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>Post Title</th>
                    <th>Post Body</th>
                    <th>Like Created At</th>
                </thead>
                <tbody>

                    @foreach ($likes as $like)
                        <tr>
                            <th> <a href="{{ route('posts.show', $like -> like_post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $like -> post_title }}</a> </th>
                            <td> {{ substr( $like -> post_body, 0, 75 ) }} {{ strlen( $like -> post_body ) > 70 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $like -> like_created_at )) }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
@endsection