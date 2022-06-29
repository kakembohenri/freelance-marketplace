@extends('layouts.base')

@section('content')
@if (session('applied'))
<div id="notification" class="notification">
    <p>{{ session('applied') }}</p>
</div>          
@endif
    <div class="home-main">

        {{-- Freelancers --}}
        @if(auth()->user()->user == 'client')
            @if( empty(request()->query('search_freelancer')) )
            <h2 id="home-title">Popular freelancers</h2>
            @elseif( request()->query('search_freelancer') )
            <h3> Search results for <strong>"{{ request()->query('search_freelancer') }}"</strong></h3>
            @endif
                <div class="home-container">
                    @forelse($freelancers as $freelancer)
                        <div class="home-container-items">
                            <div class="home-pic-and-title">
                                <div class="pic-container">
                                    {{-- Image to be fetched from the db --}}
                                        <img class="profile-pic" src="{{asset('img/' . $freelancer->user->image_path)}}">
                                </div>
                                <h2>
                                    <a href="{{ route('profile', ['user' => $freelancer->user]) }}"> {{ $freelancer->user->username }}<strong></a>
                                </h2>
                            </div>
                            <div class="home-container-item">
                                <div class="item-text">
                                    <strong>Main skill: </strong>
                                    <p>{{ $freelancer->main_skill }}</p>
                                </div>
                                <div class="item-text">
                                    <strong>About: </strong>
                                    <p>
                                        @if($freelancer->about == '')
                                            None
                                            @else
                                            {{ $freelancer->about }}
                                            @endif
                                    </p>
                                </div>
                                <div class="item-text">
                                    <strong>Other skills: </strong>
                                    <p>{{ $freelancer->skills }}</p>
                                </div>
                                <div class="item-text">
                                    <strong>Rating: </strong>
                                    <div class="stars-outer">
                                        <div class="stars-inner"></div>
                                    <span id="rating" class="active">
                                        @if($freelancer->rating == 0)
                                        0
                                        @else
                                        {{ $freelancer->rating }}
                                        @endif
                                    </span>
                                </div>
                                </div>
                                <span id="price">Fee: {{ $freelancer->price }} shs</span>  
                                <form action="{{ route('inbox', $freelancer->user) }}" class="apply">
                                    @csrf
                                    <button type="submit" class="contact-btn">
                                        Contact
                                        <span class="to-bottom"></span>
                                    </button>
                                </form>   
                            </div>
                        </div>  
                        @empty
                        <h3>No results for <strong>"{{ request()->query('search_freelancer') }}"</strong></h3>
                    @endforelse
                </div>
        @endif

        {{-- Gigs --}}
        @if(auth()->user()->user == 'freelancer')
            @if( empty(request()->query('search_gig')) )
            <h2 id="home-title">Popular gigs</h2>
            @elseif( request()->query('search_gig') )
            <h3> Search results for <strong>"{{ request()->query('search_gig') }}"</strong></h3>
            @endif
            <div class="home-container">
                @forelse ($gigs as $gig)
                <div class="home-container-items">
                    @if(isset($gig->ban))
                        <div class="bg-ban">
                            <h4>Gig has been banned!</h4>
                        </div>
                    @else
                    @endif
                    <div class="home-pic-and-title">
                        <div class="pic-container">
                            <img class="profile-pic" src="{{ asset('img/' . $gig->avatar) }}">
                        </div>
                        <h2>{{ $gig->title }}</h2>
                    </div>
                    <div class="home-container-item">
                        <div class="item-text">
                            <strong>Description:</strong>
                            <p>{{ $gig->description }}</p>
                        </div>
                        <div class="item-text">
                            <strong>Location:</strong>
                            <p>{{ $gig->location }}</p>
                        </div>
                        <div class="item-text">
                            <strong>Payment mode:</strong>
                            <p>{{ $gig->payment_mode }}</p>
                        </div>
                        <div class="item-text">
                            <strong>Status:</strong>
                            <p class="active">{{ $gig->status }}</p>
                        </div>          
                        <div class="item-text">
                            <strong>Bids:</strong>
                            <p>{{ $gig->application->count() }}</p>
                        </div> 
                        <div class="item-text">
                            <strong>Created by:</strong>
                            <p><a class="username" href="{{ route('profile', ['user' => $gig->user]) }}">{{ $gig->user->username }}</a></p>
                        </div>
                        @if($gig->application)
                            @if($gig->application->count() == 0)
                            <form action="{{ route('apply', ['gig' => $gig]) }}" method="get" class="apply">

                            @csrf
                            <button class="apply-btn" type="submit">
                                Apply
                                <span class="to-bottom"></span>
                            </button>
                            </form>
                            @else
                            @foreach($gig->application as $application)
                            @if ($application->user_id != auth()->user()->id)

                            <form action="{{ route('apply', ['gig' => $gig]) }}" method="get" class="apply">
                                @csrf
                                <button class="apply-btn" type="submit">
                                    Apply
                                    <span class="to-bottom"></span>
                                </button>
                            </form>
                            @if($application->contract->count() > 0)
                            @foreach($application->contract as $contract)
                            @if($contract->status == 'pending')
                            <div class="recieved">
                                <p>You have recieved a contract for this job!</p>
                            <a class="contract" href="{{ route('freelancer.contract', $gig) }}">View contract from here</a>
                            </div>
                            @endif
                            
                            @endforeach
                            
                            @endif
                            @else
                            <p class="applied">You already applied for this job!</p>
                            @endif
                            @endforeach
                            @endif
                            @endif
                        <span id="price">Price: {{ $gig->price }} shs</span>
                        <span id="date-posted">Posted: {{ $gig->created_at->diffForHumans() }}
                        </span>   
                        </div>
                    </div>
                    @empty
                    <h3>No results for <strong>"{{ request()->query('search_gig') }}"</strong></h3>
                </div>
                @endforelse
            </div>
        @endif
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
