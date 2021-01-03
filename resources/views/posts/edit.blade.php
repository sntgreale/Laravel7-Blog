@extends('main')

@section('pageTitle','| Edit Post')

@section('content')

{!! Form::model($post, ['route' => ['posts.update', $post -> post_id], 'method' => 'PUT']) !!}
    <div class="row">
            <div class="col-md-8">
                {{ Form::label('post_title', 'Title:') }}
                {{ Form::text('post_title', null, ['class' => 'form-control']) }}

                {{ Form::label('post_body', 'Body:', ['class' => 'form-spacing-top']) }}
                {{ Form::textarea('post_body', null, ['class' => 'form-control']) }}

                {{ Form::label('post_category_id', 'Category: ') }}
                <select class="form-control" name="post_category_id">
                    @foreach ($categories as $category)
                        @if($category -> category_id == $post -> post_category_id)
                            <option value="{{ $category -> category_id }}" selected>{{ $category -> category_name }} </option>
                        @else
                            <option value="{{ $category -> category_id }}">{{ $category -> category_name }} </option>
                        @endif
                    @endforeach
                </select>
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
                            <p> {{ date('j M, Y H:i', strtotime( $post -> post_created_at )) }} </p>
                        </div>
                    </dl>
                    <hr>
                    <div class="row">
                        @if ((Auth::user() -> id == $post -> post_user_id) or (Auth::user() -> is_admin == 1))
                            <div class="col-sm-6">
                                {!! Html::linkRoute('posts.show', 'Cancel', array($post -> post_id), array('class' => 'btn btn-danger btn-block')) !!}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
{!! Form::close() !!}

@endsection