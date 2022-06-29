<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="{{asset('css/form.css')}}">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/2.png') }}">
    </head>
    <body>
       
        <div class="bk-image"></div>
        <div class="main-container">

            <!-- <div class="form-messages"> -->
                <!-- style form messages -->
            <!-- </div> -->
    @if (session('status'))
        <div id="notification" class="notification">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <div class="form-container form-login">
        <h3 class="login">Login</h3>
             <div class="form_company-logo">
                <img src="../images/new-logo.png" alt="">
             </div>
             <div class="form-container_row">
                    <form class="signup-freelancer" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-input">
                            <i class="fab fas fa-user-circle"></i>
                            <input name="username" type="text" placeholder="Username">
                            @error('username')
                            <div class="form-input_error">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <i class="fab fas fa-key"></i>
                            <input name="password" type="password" placeholder="Password">
                            @error('password')
                            <div class="form-input_error">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-bottom">                   
                            <button type="submit" class="form-submit">Login<span class="to-right"></span></button>
                            <a href="{{ route('register') }}">Dont have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
    </html>
