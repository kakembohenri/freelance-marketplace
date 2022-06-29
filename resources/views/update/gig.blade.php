<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Showcase</title>
</head>
<body>
    <style>
        form.logout{
            position:static;
            margin:0;
        }
    </style>
    <nav>
        <ul class="items-left">           
            <li><a href="{{ route('create.gig') }}">Create a gig
                <i class="fab fab fas fa-toolbox"></i>
            </a></li>
            <li><a href="{{ route('my_gigs') }}">My Gigs
                <i class="fab fas fa-file-contract"></i>
            </a></li>
        </ul>
        <ul class="items-center">
            <li>
                <a href="{{ route('home') }}">
                <img src="{{ asset('images/new-logo.png') }}" class="company-logo">
                </a>
            </li>
        </ul>
        <ul class="items-right items-right_center">
            <li id="profile-box">
                <a href="{{ route('profile', ['user' => auth()->user()]) }}">
                    <i class="fab far fa-user-circle fa-1x"></i>
                    <span>{{ auth()->user()->username }}</span>
                </a>
            </li>
            <li><a href="{{ route('messages') }}">Messages
                <i class="fab fas fa-inbox"></i>
                </a>
            </li>
            <li>
                <form class="logout" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" value="Logout" />
                </form>
                <i class="fab fas fa-sign-out-alt"></i>
            </li>
        </ul>
    </nav>
<div class="main-container">
    <div class="form-container form-create_gig">
             
        <div class="form-container_row">
        
            <form class="signup-freelancer" action="{{ route('edit.gig', ['gig'=>$gig]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-input">
                    
                    <input type="text" name="title" value="{{ $gig->title }}" placeholder="Title">
                    <div class="form-input_error">
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">     
                    <textarea name="description" value="{{ old('description') }}" placeholder="Describe gig">{{ $gig->description }}</textarea>
                    <div class="form-input_error">
                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <input type="text" name="duration" value="{{ $gig->duration }}" placeholder="Duration">
                    <div class="form-input_error">
                        @error('duration')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <input type="text" name="location" value="{{ $gig->location }}" placeholder="Location">
                    <div class="form-input_error">
                        @error('location')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <label for="payment_mode">Payment mode: </label>
                    <select name="payment_mode" class="form-control">
                        @if($gig->payment_mode == 'fixed')
                        <option value="fixed" selected>Fixed</option>
                        <option value="hourly">Hourly</option>
                        @else
                        <option value="fixed">Fixed</option>
                        <option value="hourly" selected>Hourly</option>
                        @endif
                    </select>
                    <div class="form-input_error">
                        @error('payment_mode')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">  
                    <input type="text" name="price" value="{{ $gig->price }}" placeholder="Price">
                    <div class="form-input_error">
                        @error('price')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control">
                        @if($gig->status == 'active')
                        <option value="active" selected>Active</option>
                        <option value="closed">Closed</option>
                        @else
                        <option value="active">Active</option>
                        <option value="closed" selected>Closed</option>
                        @endif
                    </select>
                    <div class="form-input_error">
                        @error('status')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-input">
                    <label for="avatar">
                        Gig image: 
                    </label>
                    <input type="file" name="avatar" value="{{ $gig->avatar }}">
                    <div class="form-input_error">
                        @error('avatar')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-bottom">                   
                    <button type="submit" class="form-submit">Create<span class="to-right"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>