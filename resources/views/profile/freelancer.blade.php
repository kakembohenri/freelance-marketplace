@extends('layouts.base')

@section('content')
<style>

.container{
    /* justify-content: flex-start; */
    display: block;
}
    .profile-container{
        display: flex;
        justify-content: space-between;
    }

    .profile-container-personal{
        display: flex;
        flex-direction: column;
        
    }

    .personal-details{
        display: flex;
        padding: 0.5rem;
    }

.profile-pic{
    display: flex;
}
    .profile-pic > img{
        height: 20rem;
        width: 20rem;
        border-radius: 50%;
        border: 0.2rem rgb(134, 133, 133) solid;
    }

    .firsts{
        display: flex;
        flex-direction: column;
        padding: 1rem 5rem;
    }

    .username{
        display: flex;
        /* justify-content: space-between; */
        align-items: center;
    }

p.name{ 
    font-size: 3rem;
}

p.name + p{
    margin-left: 3rem;
}

.main-skill{
    font-size:2.5rem;
font-weight: bold;
color: rgb(134, 133, 133);
}

.location{
    color: rgb(134, 133, 133);
    font-weight: bold;
}

.other-skills-plus{
    display: flex;
    flex-direction: row;
    /* width: 40rem; */
    /* flex-wrap:wrap; */
}

.other-skill{
    display: flex;
    flex-wrap: wrap;
width: 50%;
margin-right: 0.5rem;
background: rgb(212, 206, 206);
justify-content: center;
border-radius: 0.5rem;
}

.firsts-others{
    display: flex;
    flex-direction: column;
    padding: 0.5rem 0rem;
}

.about {
    width: 60%;
    margin-top: 2rem;
    /* background: grey; */
}

.about-details > p{
display: flex;
flex-wrap: wrap;
}

.reviews{
    display: flex;
    flex-direction: column;
    border: 0.1rem rgb(207, 204, 204) solid;
    padding: 0.5rem;
}

.reviews-container{
    display: flex;
    flex-wrap: wrap;
    width: 60%; 
    
}

.reviews-container-ratings{
    display: flex;
    justify-content: space-between;
}

.profile-container-side{
display: flex;
flex-direction: column;
justify-content: flex-start;
max-width: 25rem;
}

.profile-container-side > a{
    background: rgb(83, 216, 83);
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.5rem;
    transition: 0.3s ease-in;
    text-align: center;
}

.profile-container-side > a:hover,
.profile-container-side > a:active {
    
    background: green;
    text-decoration: none;
}

.work-history{
margin-top: 3rem;
display: flex;
flex-direction: column;
align-content: space-between;
}

.edit{
    margin-left: 2rem;
    border: none;
    background: none;
}

.edit > a{
    background: rgb(83, 216, 83);
    color: white;
    transition: 0.3s ease-in;
    text-align: center;
    padding: 0.5rem;
    border-radius: 0.5rem;
text-decoration: none;
}

.edit > a:hover,
.edit > a:active {
    
    background: green;
    text-decoration: none;
}

.notifications{
    display: flex;
    flex-direction: column;
}
ul{
    list-style: none;
    padding-inline-start: 0px;
}

p.pending{
    background: skyblue;
    text-align: center;
}

p.accepted{
    background:rgb(83, 216, 83);
    text-align: center;
}

p.declined{
    background: crimson;
    text-align: center;
}

.rescind{
    margin-bottom: 1rem;
    padding-bottom: 0.3rem;
    border-bottom: 0.2rem solid gray;
}
    </style>
    {{-- <div class="main-profile-container"> --}}
        <div class="profile-container">
            <div class="profile-container-personal">
                <div class="personal-details">
                    <div class="profile-pic">
                        <img src="{{asset('images/' . $user->image_path)}}" alt="personal pic" />
                    </div>
                    <div class="firsts">
                        <div class="username">
                            <p class="name">{{ $user->username }}</p>
                            <p class="green">{{ $user->freelancer->price }}<p>
                                @if($user->id == auth()->user()->id)
                            <button class="edit"><a href="#">Edit profile</a></button>
                            @endif
                        </div>
                        <div class="firsts-others">
                            <p class="main-skill">{{ $user->freelancer->main_skill }}</p>
                            <p class="location">{{ $user->location }}</p>
                            <div class="other-skills-plus">
                                <p class="other-skill">{{ $user->freelancer->skills }}</p>
                            </div>
                            @if($user->freelancer->rating != 0)
                            <p class="location">Rating: {{ $user->freelancer->rating }}</p>
                            @else
                            <p>Rating: 0</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="about">
                    <h3>About</h3>
                    <div class="about-details">
                        <p>
                            {{ $user->freelancer->about }}
                        </p>
                    </div>
                </div>
                <h3>Reviews</h3>
                @if($user->review->count() == 0)
                <p>No reviews for you yet</p>
                @else
                @foreach($user->review as $review)
                    <div class="reviews">
                        <div class="reviews-container">
                            <p>{{ $review->body }}</p>
                        </div>
                        <div class="reviews-container-ratings">
                            <p>Rating: {{ $review->rating }} <span>stars</span></p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="profile-container-side">
                @if($user->id != auth()->user()->id)
                <a href="{{ route('inbox', ['user' => $user]) }}">Contact</a>
                @endif
                <div class="work-history">
                    <h3>Work History</h3>
                    <p>{{ $paid }} shs: Total earned</p>
                    <p>{{ $jobs->count() }}: Gigs completed</p>
                    <div class="notifications">
                        @if($user->id == auth()->user()->id )
                        <h3>Notifications</h3>
                        @if ($user->application)
                        <h3>Jobs applied for</h3>
                        @foreach ($user->application as $application)

                        {{-- Check if job verdict is verdict is 'Approve' and rate client--}}
                        @if($application->gig->job)
                        @if($application->gig->job->rate == 'none' && $application->gig->job->verdict == 'Approve')
                        <p class="green"><strong>{{ $application->gig->title }}</strong> has been approved.</p>
                        <p><a class="green" href="{{ route('rate.client', ['gig' => $application->gig]) }}">Please rate your experience here</a></p>
                        @endif
                        {{-- Start work after job has been paid --}}
                        @if($application->gig->job->status == 'pending')
                        <p class="green">Begin work for gig <strong>{{ $application->gig->title }}</strong> <a class="green" href="{{ route('active.job')}}">Here</p></p>
                        @endif
                        @endif
                        {{-- Application status 'Pending' --}}
                        @if($application->status == 'pending')
                        <p class="green">Application for <strong>{{ $application->gig->title }}</strong> still under review</p>
                        
                        @elseif ($application->status == 'Decline')
                        <p class="red">Application declined</p>
                        @endif
                        
                        {{-- Application status accept and contract is pending--}}
                        @if($application->contract)
                        @if ($application->status == 'Accept' && $application->contract->status == 'pending')
                        <p class="green">Application has been accepted</p>
                        <p class="green">View contract for gig <strong>{{ $application->gig->title }} applied for</strong> <a class="green" href="{{ route('contracts.view') }}">Here</a></p>
                        @endif
                        @endif

                        @endforeach
                        @else
                        <p>No applications made yet</p>
                        @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
            
@endsection
