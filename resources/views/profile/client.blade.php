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
        justify-content: space-between;
    }

p.name{ 
    font-size: 3rem;
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
    margin-left: 3rem;
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

    </style>
    {{-- <div class="main-profile-container"> --}}
        @if (session('about'))
                        <span class="help-block success">
                            <small>{{ session('about') }}</small>
                        </span>
        @endif
        <div class="profile-container">
            <div class="profile-container-personal">
                <div class="personal-details">
                    <div class="profile-pic">
                        <img src="{{asset('images/' . $user->image_path)}}" alt="personal pic" />
                    </div>
                    <div class="firsts">
                        <div class="username">
                            <p class="name">{{ $user->username }}</p>
                            @if($user->id == auth()->user()->id)
                            <button class="edit"><a href="{{ route('edit.client', ['user' => $user]) }}">Edit profile</a></button>
                            @endif
                        </div>
                        <div class="firsts-others">
                            
                            <p class="location">{{ $user->location }}</p>
                            
                            @if($user->client->average_rating == 0)
                            <p>Rating: 0</p>
                            @else
                            <p>Rating: {{ $user->client->average_rating }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="about">
                    <h3>About</h3>
                    <div class="about-details">
                        @if($user->client->about != 'none')
                        <p>{{ $user->client->about }}</p>
                        @else
                        <p>{{ $user->client->about }}</p>
                        <p style="color: red">Update your profile!</p>
                        @endif
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
                    <p>100%: Payment success</p>
                    <p>{{ $user->gig->count() }}: Gigs created</p>
                    <div class="notifications">
                        @if($user->id == auth()->user()->id)

                        <h3>Notifications</h3>
                        
                        {{-- Jobs --}}
                        @if($jobs->count() != 0)
                        <div class="contracts">
                            @foreach($jobs as $job)
                            
                            @if($job->gig)
                            {{-- Gigs belonging to a client --}}
                            @if($job->gig->user_id == $user->id)
    
                            @if($job->status == 'Begin' && $job->paid == $job->price)
                            <p class="">Job <strong>{{ $job->gig->title }}</strong> has been commenced</p>
                            @elseif($job->status == 'Complete' && $job->verdict == 'pending')
                            <p class=""> Job <strong>{{ $job->gig->title }}</strong> has been completed</p>
                            <a href="{{ route('approve', ['job' => $job]) }}" style="color:rgb(83, 216, 83);">Check here to approve submission<a>
                            @elseif($job->status == 'Complete' && $job->verdict == 'Complete')
                            <p class="">Job <strong>{{ $job->gig->title }}</strong> has been completed and approved</p>
                            @endif
                            
                            @endif
                            @endif
                            @endforeach
                        </div>
                        @else
                        <p> No notifications</p>
                        @endif
                        {{-- @else
                        <p> No notifications</p> --}}
                        @endif
                        
                        {{-- Applications --}}
                        @if($user->gig)
                        @foreach($user->gig as $gig)

                        {{-- Check for gigs with applications --}}
                        @if($gig->application)
                        
                        @foreach($gig->application as $application)
                        
                        {{-- Check for application status 'pending' --}}
                        @if($application->status == 'pending')
                        <p>View application for <strong><a class="green" href="{{ route('view.applications', ['gig' => $application->gig]) }}">{{ $application->gig->title }}</a></strong></p>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        @endif

                        {{-- Contracts --}}
                        @if($user->gig)
                        @foreach($user->gig as $gig)
                        @foreach($gig->application as $application)
                        {{-- @foreach($application->contract as $contract) --}}
                        @if($application->contract)
                        @if($application->contract->status == "Accept" && $application->gig->job->paid == 0)
                        <p class="green">Contract for <strong>{{ $application->gig->title }}</strong> has been accepted!</p>
                            <p>Proceed with making payments <a href="{{ route('payments', ['job' => $application->gig->job]) }}" class="green">Here!</a>
                        @endif
                        @endif
                        {{-- <p>{{ $application->contract }}</p> --}}
                        {{-- @endforeach --}}
                        @endforeach
                        @endforeach
                        @endif
                        {{-- <a href="{{ route('payments', $job) }}">{{ $job }}</a> --}}
                    </div>
                </div>
            </div>
        </div>
            
@endsection
