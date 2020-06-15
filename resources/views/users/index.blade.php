@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $user)
                    <div class="card">
                        <div class="card-header border-bottom-0 bg-white p-3 w-100 d-flex">
                            <img src="{{ $user->profile_image }}" class="rounded-circle" width="50" height="50">
                            {{-- <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50"> --}}
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ route('users.index') }}" class="text-secondary">{{ $user->screen_name }}</a>
                            </div>
                            @if(auth()->user()->isFollowed($user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light rounded-sm">You are followed</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if(auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', [$user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary rounded-pill">Following</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', [$user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary rounded-pill">Follow</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @if(isset($user->profile_text))
                            <div class="card-body py-0 w-100">
                                <p>{{ $user->profile_text }}</p>
                            </div>  
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection