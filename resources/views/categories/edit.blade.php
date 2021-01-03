@extends('main')

@section('pageTitle','| Edit Category')

@section('content')

{!! Form::model($category, ['route' => ['categories.update', $category -> category_id], 'method' => 'PUT']) !!}
    <div class="row">
        <div class="card card-body bg-light">
            <dl class="row">
                <div class="col-6" align="right">
                    {{ Form::label('category_name', 'Name:', ['class' => 'form-spacing-top']) }}
                </div>
                <div class="col-6">
                    {{ Form::textarea('category_name', $category -> category_name, ['class' => 'form-control']) }}
                </div>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('categories.index', 'Cancel', array($category -> categories_id), array('class' => 'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                </div>
            </div>
        </div>
    </div>
    
{!! Form::close() !!}

@endsection