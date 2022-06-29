<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Showcase</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('image/2.png') }}" >
    <title>Showcase</title>
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
                </ul>
        
            
            

                            <ul class="items-right items-right_center">
                                <li id="profile-box">
                                    <a href="{{ route('profile', ['user' => auth()->user()]) }}">
                                    <i class="fab far fa-user-circle fa-1x">
                                    </i>
                                    <span>{{ auth()->user()->username }}</span>
                                </a>
                            </li>
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
<div class="home-main">
    <div class="messages-main_container">
        <div class="user-message_details">
            <img src="{{ asset('img/'. $user->image_path) }}" alt="">
            <p>{{ $user->username }}</p>
            
        </div>
        <div class="message-container">
            @foreach($messages as $message)
            <div class="message-details">
                {{-- Message sent to me by this user --}}
                @if($message->user_from == $user->id && $message->user_to == auth()->user()->id)
                <div class="message-receiver">
                    <p>                       
                         {{ $message->body }} 
                    </p>
                    
                    <span>{{ $message->created_at->diffForHumans() }}</span>
                </div>
                {{-- Message sent by me to this user --}}
                @elseif($message->user_from == auth()->user()->id && $message->user_to == $user->id)
                <div class="message-sender">
                    <p>
                        {{ $message->body }}
                    </p>
                    <span>{{ $message->created_at->diffForHumans() }}</span>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <form action="{{ route('message.send', ['user' => $user]) }}" class="send" method="post">
            @csrf
            <input type="text" name="body" placeholder="Send message" />
            @error('body')
            <div class="form-input_error">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </form>
    </div>  
</div>
</body>
</html>