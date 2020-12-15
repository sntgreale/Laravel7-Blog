@extends('main')

@section('pageTitle', ' | All Followed of User')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Followed of:  </h1>
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
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Relationship Created At</th>
                </thead>
                <tbody>

                    @foreach ($followeds as $follow)
                        <tr>
                            <th> <a href="{{ route('users.show', $follow -> userFollowed_id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $follow -> name  }}</a> </th>
                            <td> {{ $follow -> email }} </td>
                            <td> {{ date('j M, Y', strtotime( $follow -> follow_created_at )) }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <br>
@endsection