@extends('main')

@section('pageTitle', ' | All Users')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h1>All Users</h1>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <th> {{ $user -> id }} </th>
                            <th> <a href="{{ route('users.show', $user -> id) }}" class="btn-camp btn btn-outline-dark btn-sm btn-block">{{ $user -> name }}</a> </th>
                            <td> {{ $user -> email }} </td>
                            <td> {{ date('j M, Y', strtotime( $user -> created_at )) }} </td>
                            <td>
                                <a href="{{ route('users.show', $user -> id) }}" class="btn-up btn btn-outline-primary btn-sm btn-block">View</a>
                                {!! Form::open(['route' => ['users.destroy', $user -> id], 'method' => 'DELETE']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-up btn-outline-danger btn btn-sm btn-block']) !!}
                                {!! Form::close() !!}
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
            {!! $users -> links(); !!}
        </div>
    </div>
@endsection