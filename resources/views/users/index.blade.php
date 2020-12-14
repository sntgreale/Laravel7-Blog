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
                            <th> {{ $user -> name }} </th>
                            <td> {{ $user -> email }} </td>
                            <td> {{ date('j M, Y', strtotime( $user -> created_at )) }} </td>
                            <td>
                                <a href="{{ route('users.show', $user -> id) }}" class="btn btn-primary btn-sm">View</a>
                                {!! Form::open(['route' => ['users.destroy', $user -> id], 'method' => 'DELETE']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn btn-primary btn-sm']) !!}
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