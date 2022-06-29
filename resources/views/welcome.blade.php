<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Showcase</title>
</head>
<body>
    <nav>
        <ul class="items-left">
            <li><a style="background: crimson; border-radius: 0.5rem; color: white;" href="#">Home</a></li>
            <li><a href="#">What is showcase?</a></li>
        </ul>
        <ul class="items-center">
            <li><img src="{{ asset('images/new-logo.png') }}" class="company-logo"></li>
            <li><ul class="items-center_below">
                <li><a href="{{ route('login') }}">Login</a></li>
                <span class="border"></span>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul></li>
        </ul>
        <ul class="items-right">
            <li><a href="#features-header">Features</a></li>
            <li><a href="#contact-us">Contact us</a></li>
        </ul>
    </nav>
    <header>
        <div class="images-slideshow">
           <img src="{{ asset('images/img1.jpeg') }}">
           <img src="{{ asset('images/img2.jpeg') }}">
           <img src="{{ asset('images/img3.jpeg') }}">
        </div>
        <div class="title-section">
            <h3>SHOWCASE</h3>
            <p>An online market place for student freelancers to - you guessed right - showcase their skills and abilities to the public which promises them financial empowerment and building experience in their niches of choice</p>
            <a href="#">Read More<span class="to-right"></span></a>
        </div>
    </header>
    <div class="features-container">
        <h3 id="features-header" class="features-header">Features</h3>
        <div class="features-items">
            <div class="feature-item">
                <div class="detail-container">
                    <p>Sign up as a student freelancer and get to explore the immense opportunities showcase has in store for you</p>
                    <a href="{{ route('register') }}">Join<span class="to-top"></span></a>
                </div>
                <span class="img-slide">
                    
                </span>
                <img src="{{ asset('images/freelancer1.jpg') }}" alt="">
                <p>Freelancer</p>
            </div>
            <div class="feature-item">
                <div class="detail-container">
                    <p>You will be able to work with a pool of students who are passionate about their craft</p>
                    <a href="{{ route('register') }}">Join<span class="to-top"></span></a>
                </div>
                <span class="img-slide">
                </span>
                <img src="{{ asset('images/client.jpeg') }}" alt="">
                <p>Client</p>
            </div>
            <div class="feature-item">
                <div class="detail-container">
                    <p>Showcase includes a secure payment system integrated in the system which makes transfer of funds frictionless</p>
                    <a href="#">Read More<span class="to-top"></span></a>
                </div>
                <span class="img-slide"></span>
                <img src="{{ asset('images/online-payment.jpeg') }}" alt="">
                <p>Integrated Pay</p>
            </div>
        </div>
    </div>
    <footer>
        <ul class="socials" id="contact-us">
            <li><i class="fab fa-facebook fa-2x"></i></li>
            <li><i class="fab fa-twitter fa-2x"></i></li>
            <li><i class="fab fa-instagram fa-2x"></i></li>
        </ul>
        <p><strong>
            SHOWCASE &copy; 2022
        </strong></p>
    </footer>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>