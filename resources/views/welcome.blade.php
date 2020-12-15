@extends('main')

@section('pageTitle', ' | Welcome')

@section('content')
    <div class="row">
        <div class="col-md-4 mx-auto">
            <h2>Welcome to rePosT</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            rePost is a blog where you can create your own posts, comment on the posts you want, follow your friends or favorite users, in addition, you can refuel the posts you want to share them with your followers and like to find them in the future.
        </div>
    </div>
    <hr>
    <div class="row cards-welcome-container">
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-outline-primary btn-block" disabled>Follow</button>
                    </div>
                </div>
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Follow your friends</h5>
                    <p class="card-text">Follow your friends don't miss their last activity.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-outline-success btn-block" disabled>RePost</button>
                    </div>
                </div>
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Refuelling the Posts</h5>
                    <p class="card-text">Repost the posts you want to share with your followers.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-outline-danger btn-block" disabled>Like</button>
                    </div>
                </div>
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Like the Posts</h5>
                    <p class="card-text">Like the posts you want to find them faster.</p>
                </div>
            </div>
        </div>
    </div>
@endsection