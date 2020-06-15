@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        <img src="{{ $user->profile_image }}" class="rounded-circle" width="100" height="100">
                        {{-- <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="100" height="100"> --}}
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                            <span class="text-secondary">{{ $user->screen_name }}</span>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">Edit Profile</a>
                                @else
                                    @if ($is_following)
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

                                    @if ($is_followed)
                                        <div class="mt-2 px-2 bg-secondary text-light rounded-sm">You are followed</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">Questions</p>
                                <span>{{ $question_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">Following</p>
                                <span>{{ $follow_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">Followed</p>
                                <span>{{ $follower_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <p>{{ $user->profile_text }}</p>
                </div>
            </div>
        </div>
        @if (isset($questions))
            @foreach ($questions as $question)
                <div class="col-md-8 mb-2">
                    <div class="card border-primary">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="{{ $user->profile_image }}" class="rounded-circle" width="50" height="50">
                            {{-- <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50"> --}}
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <p class="mb-0">{{ $question->user->name }}</p>
                                <a href="{{ url('users/' .$question->user->id) }}" class="text-secondary">{{ $question->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $question->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $question->text }}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-between bg-white border-top-0 mb-1">
                            <div class="d-flex">
                                <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-2 py-1">
                                    <a href="{{ url('questions/' .$question->id) }}"><i class="far fa-comment fa-fw mr-1 text-light"></i></a>
                                    <p class="mb-0 text-secondary text-light">{{ count($question->answers) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if (!in_array(Auth::user()->id, array_column($question->favorites->toArray(), 'user_id'), TRUE))
                                        <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                            @csrf
    
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                        </form>
                                    @else
                                        <form method="POST"action="{{ url('favorites/' .array_column($question->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
    
                                            <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                        </form>
                                    @endif
                                    <p class="mb-0 text-secondary">{{ count($question->favorites) }}</p>
                                </div>    
                            </div>
                            @if ($question->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{ url('questions/' .$question->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ url('questions/' .$question->id .'/edit') }}" class="dropdown-item">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                            <button type="submit" class="dropdown-item del-btn text-danger">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- <div class="card-footer py-1 d-flex justify-content-end bg-white border-top-0">
                            @if ($question->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{ url('questions/' .$question->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ url('questions/' .$question->id .'/edit') }}" class="dropdown-item">Edit</a>
                                            <button type="submit" class="dropdown-item del-btn">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('questions/' .$question->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($question->answers) }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if (!in_array(Auth::user()->id, array_column($question->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf

                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST"action="{{ url('favorites/' .array_column($question->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary">{{ count($question->favorites) }}</p>
                            </div>

                        </div> --}}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $questions->links() }}
    </div>
</div>
@endsection