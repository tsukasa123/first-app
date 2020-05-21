@extends('layouts.app')

@section('content')
<div class="container bg-white mb-5 border rounded py-3">
    <div class="row justify-content-center">
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
                    {!! nl2br(e($question->text)) !!}
                </div>
                <div class="card-footer py-1 d-flex justify-content-between bg-white border-top-0 mb-1">
                    <div class="d-flex">
                        <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-3 py-1">
                            <a href="{{ url('questions/' .$question->id) }}" class="text-white"><i class="far fa-comment fa-fw mr-1"></i></a>
                            <p class="mb-0 text-white">{{ count($question->answers) }}</p>
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
                    <div class="mr-3 d-flex align-items-center bg-primary rounded-pill px-3 py-1">
                        <a href="{{ url('questions/' .$question->id) }}" class="text-white"><i class="far fa-comment fa-fw mr-1"></i></a>
                        <p class="mb-0 text-white">{{ count($question->answers) }}</p>
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
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <ul class="list-group">
                @forelse ($answers as $answer)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            <img src="{{ asset('storage/profile_image/' .$answer->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $answer->user->name }}</p>
                                <a href="{{ url('users/' .$answer->user->id) }}" class="text-secondary">{{ $answer->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $answer->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="py-3">
                            {!! nl2br(e($answer->text)) !!}
                        </div>

                        @if ($answer->user->id === Auth::user()->id)
                            <div class="dropdown mr-3 d-flex align-items-center justify-content-end">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-fw"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <form method="POST" action="{{ url('answers/' .$answer->id) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ url('answers/' .$answer->id .'/edit') }}" class="dropdown-item">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <button type="submit" class="dropdown-item del-btn text-danger">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">No answer yet</p>
                    </li>
                @endforelse
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ route('answers.store') }}">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $user->name }}</p>
                                        <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <p class="mb-4 text-danger"></p>
                                    <button type="submit" class="btn btn-primary rounded-pill ">
                                        Answer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection