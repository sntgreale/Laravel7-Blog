@extends('main')

@section('pageTitle','| Edit Category')

@section('content')

{!! Form::model($category, ['route' => ['categories.update', $category -> category_id], 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Edit Category</h5>
                <div class="card-body">
                    {{ Form::label('category_name', 'Name:', ['class' => 'form-spacing-top']) }}
                    {{ Form::text('category_name', $category -> category_name, ['class' => 'form-control']) }}
                    <br>
                    {!! Html::linkRoute('categories.index', 'Cancel', array($category -> categories_id), array('class' => 'btn btn-danger btn-block')) !!}
                    {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                </div>
            </div>
        <div>
    </div>
    
{!! Form::close() !!}

@endsection