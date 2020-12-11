@extends('main')

@section('pageTitle','| Edit Post')

@section('content')

{!! Form::model($post, ['route' => ['posts.update', $post -> id], 'method' => 'PUT']) !!}
    <div class="row">
            <div class="col-md-8">
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}

                {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
                {{ Form::textarea('body', null, ['class' => 'form-control']) }}
            </div>
            
            <div class="col-md-4">
                <div class="card card-body bg-light">
                    <dl class="row">
                        <div class="col-6" align="right">
                            <p> <strong> Author: </strong> </p>
                        </div>
                        <div class="col-6">
                            <p> {{ $post -> name }} </p>
                        </div>
                    </dl>
                    <dl class="row">
                        <div class="col-6" align="right">
                            <p> <strong> Created At: </strong> </p>
                        </div>
                        <div class="col-6">
                            <p> {{ date('j M, Y H:i', strtotime( $post -> created_at )) }} </p>
                        </div>
                    </dl>
                    <dl class="row">
                        <div class="col-6" align="right">
                            <p> <strong> Last Updated: </strong> </p>
                        </div>
                        <div class="col-6">
                            <p> {{ date('j M, Y H:i', strtotime( $post -> updated_at )) }} </p>
                        </div>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.show', 'Cancel', array($post -> id), array('class' => 'btn btn-danger btn-block')) !!}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
{!! Form::close() !!}

@endsection