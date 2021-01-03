@extends('main')

@section('pageTitle', ' | All Categories')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>All Categories</h1>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- End of .row-->
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            <th> {{ $category -> category_id }} </th>
                            <th> {{ $category -> category_name }} </th>
                            <td> {{ date('j M, Y', strtotime( $category -> category_created_at )) }} </td>
                            <td>
                                <a href="{{ route('categories.edit', $category -> category_id) }}" class="btn-up btn btn-outline-primary btn-sm btn-block">Edit</a>

                                {!! Form::open(['route' => ['categories.destroy', $category -> category_id], 'method' => 'DELETE']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-up btn-outline-danger btn btn-sm btn-block']) !!}
                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">New Category</h5>
                <div class="card-body">
                    {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
                        {{ Form::label('category_name', 'Name:') }}
                        {{ Form::text('category_name', null, ['class' => 'form-control']) }}
                        <br>
                        {{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mx-auto">
            {!! $categories -> links(); !!}
        </div>
    </div>
@endsection