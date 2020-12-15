@extends('main')

@section('pageTitle', ' | All Reposts of User')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Reposts of:  </h1>
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
                    <th>Repost Created At</th>
                </thead>
                <tbody>

                    @foreach ($reposts as $repost)
                        <tr>
                            <th> <a href="{{ route('posts.show', $repost -> repost_post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $repost -> post_title }}</a> </th>
                            <td> {{ substr( $repost -> post_body, 0, 75 ) }} {{ strlen( $repost -> post_body ) > 70 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $repost -> repost_created_at )) }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
@endsection