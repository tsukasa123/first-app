<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top p-0">
    <div class="container">
        <a class="navbar-brand p-0" href="{{ url('/questions') }}">
            <img src="https://tsukasa-s3-bucket.s3-ap-northeast-1.amazonaws.com/feartalk.png" height="50" width="130">
            {{-- <img src="{{ asset('storage/profile_image/FearTalk.png')}}" height="50" width="130"> --}}
            {{-- {{ config('app.name', 'Laravel') }} --}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @include('include.search')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-center">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-light rounded-pill mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link border border-primary text-primary rounded-pill" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item mr-2">
                        <a href="{{ url('questions') }}" class="btn btn-md btn-secondary rounded-pill d-flex">
                            <i class="fas fa-home pt-1 mr-1 text-white"></i> Home
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="{{ url('questions/create') }}" class="btn btn-md btn-primary rounded-pill d-flex">
                            <i class="fas fa-feather-alt pt-1 mr-1"></i>Ask
                        </a>
                    </li>
                    <li class="nav-item">
                        <img src="{{ auth()->user()->profile_image }}" class="rounded-circle" width="40" height="40">
                        {{-- <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}" class="rounded-circle" width="40" height="40"> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('users.show', [Auth::user()->id]) }}">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>