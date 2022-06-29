<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../css/form.css') }}">
    <title>Sign Up</title>
</head>
<body>
    <style>
        .cofirmation-container{
            position: fixed;
            top:0;
            left:0;
            height: 100%;
            width: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 100;
        }

        .confirm-message{
            position: relative;
            top:25%;
            left: 50%;
            transform: translate(-50%,0%);
            height: 6rem;
            width: 30rem;
            padding: 2rem;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            word-wrap: break-word;
        }

        .confirm-message h3{
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(0,0,0,0.7);
            font-weight: 600;
            font-size: 1.6rem;
        }

        .confirm-message h3 i{
            color: lightgreen;
            margin-left: 0.5rem;
        }

        .confirm-message p{
            margin: 1rem 0rem;
            color: rgba(0,0,0,0.7);
        }
    </style>
    @if(session('exist'))
    <div id="notification"> 
        <p>{{ session('exist') }}</p>
     </div> 
     @endif
     {{-- @if(session('confirm'))
     <div class="cofirmation-container">
        <div class="confirm-message">
            <h3>Complete registration<i class="fas fa-info-circle"></i></h3>
            <p>{{ session('confirm') }}</p>
        </div>
     </div>
     @endif --}}
    <div class="bk-image"></div>
    <div class="main-container">
        <div class="form-container">
            <div class="form-choice">
                <span class="slider"></span>
                <button class="toggle-btn">Freelancer</button>
                <button class="toggle-btn">Client</button>
            </div>
             <div class="form_company-logo">
                <img src="{{ asset('../images/new-logo.png') }}" alt="company-logo">
            </div>
            <div class="form-container_row">
                <!-- Freelancer signup -->
            <form action="{{ route('register.freelancer') }}" class="signup-freelancer" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-input">
                    <input name="fname" type="text" placeholder="First name" value="{{ old('fname') }}">

                    @error('fname')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="lname" type="text" placeholder="Last name" value="{{ old('lname') }}">
                    @error('lname')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="username" type="text" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="email" type="text" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="student_reg_no" type="text" placeholder="Reg number i.e 18/U/23..." value="{{ old('student_reg_no') }}">
                    @error('student_reg_no')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="main_skill" type="text" placeholder="Main skill" value="{{ old('main_skill') }}">
                    @error('main_skill')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="other_skills" type="text" placeholder="Other skills" value="{{ old('other_skills') }}">
                    @error('other_skills')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="fee" type="text" placeholder="Fee" value="{{ old('fee') }}">
                    @error('fee')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input input-gender">
                    <label for="gender">Gender:</label>
                    <div class="form-input_gender">
                        Male:<input name="gender" type="checkbox" value="male">
                        Female:<input name="gender" type="checkbox" value="female">
                    </div>
                    @error('gender')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="location" type="text" placeholder="Location" value="{{ old('location') }}">
                    @error('location')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <textarea name="bio" placeholder="Write something about thy self" value="{{ old('bio') }}"></textarea>
                    @error('bio')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="image" type="file">
                    @error('image')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="password" type="password" placeholder="Password">
                    @error('password')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="password_confirmation" type="password" placeholder="Confirm password">
                    @error('password_confirmation')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-bottom">                   
                    <button type="submit" class="form-submit">Register<span class="to-right"></span></button>
                    <a href="{{ route('login') }}">Have an account?</a>
                </div>
                
            </form>
            <!-- Client signup -->
            {{-- {{ route('register.client') }} --}}
            <form class="signup-client" method="POST" action="{{ route('register.client') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-input">
                    <input name="fname" type="text" placeholder="First name" value="{{ old('fname') }}">

                    @error('fname')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="lname" type="text" placeholder="Last name" value="{{ old('lname') }}">
                    @error('lname')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="username" type="text" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="email" type="text" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input input-gender">
                    <label for="gender">Gender:</label>
                    <div class="form-input_gender">
                        <label>Male:</label>
                            <input name="gender" type="checkbox" value="male">
                        <label>Female:</label>
                        <input name="gender" type="checkbox" value="female">
                    </div>
                    @error('gender')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="location" type="text" placeholder="Location" value="{{ old('location') }}">
                    @error('location')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <textarea name="bio" placeholder="Write something about thy self" value="{{ old('bio') }}"></textarea>
                    @error('bio')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="image" type="file">
                    @error('image')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="password" type="password" placeholder="Password">
                    @error('password')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-input">
                    <input name="password_confirmation" type="password" placeholder="Confirm password">
                    @error('password_confirmation')
                    <div class="form-input_error">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-bottom">                   
                    <button type="submit" class="form-submit">Register<span class="to-right"></span></button>
                    <a href="{{ route('login') }}">Have an account?</a>
                </div>
                
            </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</body>
</html>