@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center border rounded bg-white">
        <div class="col-md-8 my-3 text-right">
            <a href="{{ url('users') }}">User List <i class="fas fa-users ml-1" class="fa-fw"></i> </a>
        </div>
        @if (isset($questions))
            @foreach ($questions as $question)
                <div class="col-md-8 mb-3">
                    <div class="card border-primary">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="{{ asset('storage/profile_image/' .$question->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $question->user->name }}</p>
                                <a href="{{ url('users/' .$question->user->id) }}" class="text-secondary">{{ $question->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $question->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('questions/' .$question->id) }}" style="font-size: 1.1rem;">
                                {!! nl2br(e($question->text)) !!}
                            </a>
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-between bg-white border-top-0">
                            <div class="d-flex">
                                <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-3 py-1">
                                    <a href="{{ url('questions/' .$question->id) }}"><i class="far fa-comment fa-fw mr-1 text-light"></i></a>
                                    <p class="mb-0 text-secondary text-light">{{ count($question->answers) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if (!in_array($user->id, array_column($question->favorites->toArray(), 'user_id'), TRUE))
                                        <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                            @csrf

                                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw mr-1"></i></button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ url('favorites/' .array_column($question->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw mr-1"></i></button>
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

                        {{-- Default card-footer --}}
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
                            <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-3 py-1">
                                <a href="{{ url('questions/' .$question->id) }}"><i class="far fa-comment fa-fw mr-1 text-light"></i></a>
                                <p class="mb-0 text-secondary text-light">{{ count($question->answers) }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if (!in_array($user->id, array_column($question->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf

                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw mr-1"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($question->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw mr-1"></i></button>
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