@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center bg-white">
        <div class="row d-flex my-5 align-items-center">
            <h1 class="text-center" style="font-size: 4rem;">Welcome to</h1>
            <img src="{{ $logo }}" width="280" height="110">
            {{-- <img src="{{ asset('storage/profile_image/FearTalk.png') }}" width="280" height="110"> --}}
        </div>

        <div class="col-md-8 mb-3 border py-3">
            <h2 class="text-primary text-center rounded-lg py-2">Post Your Questions!</h2>
            <h3 class="text-center">Get rid of your fear!<br> You can find your cause of fear.</h3>
            <div class="row justify-content-center">
                <img src="{{ $first_image }}">
                {{-- <img src="/storage/profile_image/image1.png"> --}}
            </div>
            {{-- <div class="card border-primary">
                <div class="card-haeder p-3 w-100 d-flex">
                    <img src="{{ asset('storage/profile_image/default.png') }}" class="rounded-circle" width="50" height="50">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">ABC</p>
                        <p class="text-secondary">ABC123</p>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">2020-05-22 15:52</p>
                    </div>
                </div>
                <div class="card-body">
                    <p style="font-size: 1.1rem;">
                        Can the coronavirus disease spread through food?
                    </p>
                </div>
                <div class="card-footer py-1 d-flex justify-content-between bg-white border-top-0">
                    <div class="d-flex">
                        <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-3 py-1">
                            <i class="far fa-comment fa-fw mr-1 text-light"></i>
                            <p class="mb-0 text-secondary text-light">2</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw mr-1"></i></button>
                            <p class="mb-0 text-secondary">13</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <h3 class="text-center py-2" style="font-size: 3rem;">↓</h3>
            <h2 class="text-primary text-center rounded-lg pb-2">Get Answers From Strangers!</h2>
            <h3 class="text-center pb-2">Someone will answer your questions!</h2>
            <div class="row justify-content-center">
                <img src="{{ $second_image }}">
                {{-- <img src="/storage/profile_image/image2.png" alt=""> --}}
            </div>
            <h2 class="text-primary text-center rounded-lg pt-5">Let's Ask Right Now!!</h2>
            <div class="row justify-content-center py-2 px-5 mb-5">
                <a class="form-control btn btn-primary btn-lg rounded-pill" href="{{ route('register') }}">{{ __('Get Started!') }}</a>
            </div>
        </div>
    
    </div>


</div>

@endsection

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}
