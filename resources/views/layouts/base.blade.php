<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Showcase</title>
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('image/2.png') }}" >
</head>
<body>
<nav>

    <ul class="items-left">           
        @if(auth()->user()->user == 'client')
        <li><a href="{{ route('create.gig') }}">Create a gig
            <i class="fab fab fas fa-toolbox"></i></a></li>
        <li><a href="{{ route('my_gigs') }}">My Gigs
            <i class="fab fas fa-file-contract"></i></a></li>
        @endif
        @if(auth()->user()->user == 'freelancer')
        <li><a href="{{ route('active.job')}}">Active jobs</a></li>
        <li><a href="{{ route('contracts.view') }}">Contracts
            <i class="fab fas fa-file-contract"></i></a></li>
        @endif
        @if(auth()->user()->user == 'admin')
        <li>
            <a href="{{ route('register.admin') }}">Manage Admin</a>
        </li>
        <li>
            <a href="{{ route('gig.ban') }}">Manage Gigs</a>
        </li>
    </ul>
        @endif
    
                <ul class="items-center">
                    <li>
                        @if(auth()->user()->user == 'freelancer' || auth()->user()->user == 'client')
                        <a href="{{ route('home') }}">
                        <img src="{{ asset('../images/new-logo.png') }}" class="company-logo">
                        </a>
                        @else
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('../images/new-logo.png') }}" >
                </a>
                @endif
                    </li>
                    <li>
                        <ul class="items-center_below">
                            <li>
                                <form action="{{ route('home') }}" method='get'>
                                    @if(auth()->user()->user == 'freelancer')
                                        <input type="text"  name="search_gig" class="search-bar" value="{{ request()->query('search') }}" placeholder="Find gigs">
                                    @elseif(auth()->user()->user == 'client')
                                        <input type="text" name="search_freelancer" class="search-bar" value="{{ request()->query('search') }}" placeholder="Find freelancers">    
                                    @endif
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
        
            
            

                            <ul class="items-right items-right_center">
                                @if(auth()->user()->user == 'admin')
                                @else
                                <li id="profile-box">
                                    <a href="{{ route('profile', ['user' => auth()->user()]) }}">
                                    <i class="fab far fa-user-circle fa-1x">
                                    </i>
                                    <span>{{ auth()->user()->username }}</span>
                                </a>
                            </li>
                            @endif
                            <li><a href="{{ route('messages') }}">Messages
                                <i class="fab fas fa-inbox"></i></a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                      <input type="submit" value="Logout" />
                                </form>
                                <i class="fab fas fa-sign-out-alt"></i>
                            </li>
                        </ul>
</nav>
        @yield('content')
        <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
