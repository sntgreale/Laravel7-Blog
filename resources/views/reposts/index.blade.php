@extends('main')

@section('pageTitle', ' | All Reposts')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Reposts</h1>
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
                    <th>Repost Created At</th>
                </thead>
                <tbody>

                    @foreach ($reposts as $repost)
                        <tr>
                            <th> <a href="{{ route('users.show', $repost -> repost_user_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $repost -> name }}</a> </th>
                            <td> {{ $repost -> email }} </td>
                            <td> {{ $repost -> repost_post_id }} </td>
                            <th> <a href="{{ route('users.show', $repost -> repost_post_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $repost -> post_title }}</a> </th>
                            <td> {{ substr( $repost -> post_body, 0, 50 ) }} {{ strlen( $repost -> post_body ) > 50 ? '...' : '' }} </td>
                            <td> {{ date('j M, Y', strtotime( $repost -> repost_created_at )) }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mx-auto">
            {!! $reposts -> links(); !!}
        </div>
    </div>
@endsection