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
                    <th>Post Title</th>
                    <th>Post Body</th>
                    <th>Repost Created At</th>
                </thead>
                <tbody>

                    @foreach ($reposts as $repost)
                        <tr>
                            <td> {{ Html::linkRoute('users.show', $repost -> name , [$repost -> repost_user_id], ['class' => 'btn btn-link']) }} </td>
                            <td> {{ $repost -> email }} </td>
                            <td> {{ Html::linkRoute('posts.show', $repost -> post_title , [$repost -> repost_post_id], ['class' => 'btn btn-link']) }} </td>
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