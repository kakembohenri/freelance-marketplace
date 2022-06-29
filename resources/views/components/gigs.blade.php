@props(['gigs' => $gigs])
@if(auth()->user()->user == 'freelancer')
                @if (session('applied'))
                    <span class="help-block success">
                        <small>{{ session('applied') }}</small>
                    </span>
            @endif
            @if( empty(request()->query('search_gig')) )
            <h2 id="home-title">Popular gigs</h2>
            @elseif( request()->query('search_gig') )
            <h3> Search results for <strong>{{ request()->query('search_gig') }}</strong></h3>
            @endif
            <div class="home-container">
                @forelse ($gigs as $gig)
                <div class="home-container-items">
                    <div class="home-pic-and-title">
                        <div class="pic-container">
                            <img class="profile-pic" src="{{ asset('images/' . $gig->user->image_path) }}">
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
                            <p><a href="{{ route('client', ['user' => $gig->user]) }}">{{ $gig->user->username }}</a></p>
                        </div>
                        @if($gig->application)
                            @if($gig->application->count() == 0)
                            <form action="{{ route('apply', ['gig' => $gig]) }}" method="get" class="apply">

                            @csrf
                            <button type="submit">
                                Apply
                                <span class="to-bottom"></span>
                            </button>
                            </form>
                        @else
                            @foreach($gig->application as $application)
                            @if ($application->user_id != auth()->user()->id)

                            <form action="{{ route('apply', ['gig' => $gig]) }}" method="get">
                                @csrf
                                <input class="apply" type="submit" value="Apply" />
                            </form>
                            @if($application->contract->count > 0)
                            @foreach($application->contract as $contract)
                            @if($contract->status == 'pending')
                            <p>You have recieved a contract for this job!</p>
                            <a class="contract" href="{{ route('freelancer.contract', $gig) }}">View contract from here</a>
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
                    <h3>No results for <strong>{{ request()->query('search_gig') }}</strong></h3>
                </div>
                @endforelse
            </div>
@endif