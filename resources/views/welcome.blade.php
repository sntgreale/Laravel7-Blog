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
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
    </div>
    <hr>
    <div class="row cards-welcome-container">
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card card-welcome" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <hr>
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
@endsection