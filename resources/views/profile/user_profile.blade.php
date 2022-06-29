    @extends('layouts.base')

    @section('content')
    <div class="profile-main">
        <!-- <div class="form-messages"> -->
            <!-- style form messages -->
        <!-- </div> -->
        <div class="profile-container">
            <div class="personal-section1">
                <div class="home-pic">
                    <img src="{{asset('img/' . $user->image_path)}}" alt="">
                </div>
                <div class="personal-section2">
                    <h2>
                        {{ $user->username }}
                    </h2>
                    @if($user->user == 'freelancer')
                    <h3>
                        {{ $user->freelancer->main_skill }}
                    </h3>
                    @endif
                    <ul class="socials">
                        <li><i class="fab fa-facebook fa-2x"></i></li>
                        <li><i class="fab fa-twitter fa-2x"></i></li>
                        <li><i class="fab fa-instagram fa-2x"></i></li>
                    </ul>
                </div>
                <div class="personal-section3">
                    @if($user->user == 'freelancer')
                    <p>Fee:
                        <span id="fee">{{ $user->freelancer->price }}</span>
                        shillings
                    </p>
                    @endif
                    <p>Rating:
                        <div class="stars-outer">
                            <div class="stars-inner"></div>
                            <span id="rating">
                                @if(isset($user->client))
                                    @if($user->client->average_rating == 0 || $user->client->average_rating == null)
                                    0
                                    @else
                                    {{ $user->client->average_rating }}
                                    @endif
                                @elseif(isset($user->freelancer))
                                    @if($user->freelancer->rating == 0 || $user->freelancer->rating == null)
                                    0
                                    @else
                                    {{ $user->freelancer->rating }}
                                    @endif
                                @endif
                            </span>
                        </div>
                        
                    </p>
                </div>
                <div class="personal-section4">
                    @if($user->id == auth()->user()->id)
                        <a class="edit" href="{{ route('edit.client', ['user' => $user]) }}">Edit
                            <i class="fab far fa-edit"></i>
                            <span class="slide-blue"></span> 
                        </a>
                            
                    @endif
                    @if($user->id != auth()->user()->id)
                        <a class="contact-me"href="{{ route('inbox', ['user' => $user]) }}">Contact me
                            <i class="fab far fa-paper-plane"></i>
                            <span class="slide-green"></span>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="section-main">
            <div class="section-left">
                <div class="about-me">
                    <h3>About</h3>
                    <p>
                        @if(isset($user->client))
                        {{ $user->client->about }}
                        @elseif(isset($user->freelancer))
                        {{ $user->freelancer->about }}
                        @endif
                    </p>
                </div>
                <div class="reviews">
                    <h3>Reviews</h3>
                    @if($user->review->count())
                    @foreach($user->review as $review)
                    <div class="review-items">
                        <p>
                            {{ $review->body }}
                        </p>
                        <div class="rating-and-date">
                            <div class="stars-outer">
                                <div class="stars-inner"></div>
                            <span id="rating">{{ $review->rating }}</span>
                            </div>
                            <span class="date">
                                {{ $review->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No reviews</p>
                    @endif
                    
                </div>
            </div>
            <div class="section-right">
                <div class="others">
                    <p>
                        <i class="fab fas fa-location-arrow fa-1x"></i>
                        {{ $user->location }}
                    </p>
                    <p>
                        <i class="fab fas fa-link"></i>
                       work in progress
                    </p>
                    @if(isset($user->freelancer))
                    <p>
                        <i class="fab fas fa-hands"></i>
                        {{ $user->freelancer->skills }}
                    </p>
                    @endif
                </div>
                <div class="work-history">
                    <h3>
                        <i class="fab fas fa-history"></i>
                        Work History
                    </h3>
                    @if(isset($user->client))
                    <p>Gigs created:
                        @if(isset($user->gig))
                        {{ $user->gig->count() }}
                        @else
                        0
                        @endif
                    </p>
                    <p>
                        Gigs payment success:
                        @if($user->gig->count() > 0)
                        <?php
                        $total_price = 0;
                        $total_paid = 0;
                        ?>
                        @foreach($user->gig as $gig)
                        @if($gig->job)
                        <?php 
                        $total_price += $gig->job->price;
                        $total_paid += $gig->job->paid
                        ?>
                        @endif
                        @endforeach
                        <?php
                        if(($total_paid == 0 || $total_price == 0) || ($total_paid == 0 && $total_price == 0))
                        {
                            echo (0)."%";
                        }else{
                            echo ($total_paid/$total_price * 100)."%";
                        }
                        ?>
                        @endif
                    </p>
                    @endif
                    @if(isset($user->freelancer))
                    <p>
                        Total earned:
                        <?php
                        $total = 0;
                        ?>
                        {{-- @if($user->job->count() > 0) --}}
                        @foreach($user->job as $job)
                        <?php
                        $total += $job->paid
                        ?>
                        @endforeach
                        {{ $total }} shillings
                        {{-- @endif --}}
                    </p>
                    <p>
                        Gigs completed:
                        <?php
                        $count = 0;
                        ?>
                        @foreach($user->job as $job)
                        @if($job->status == 'Complete' && $job->verdict == 'Approve')
                        <?php
                        $count ++;
                        ?>
                        @endif
                        @endforeach
                        {{ $count }}
                    </p>
                    @endif
                </div>
                @if($user->id == auth()->user()->id)
                <div class="notifications">
                    <h3>
                        <i class="fab far fa-bell"></i>
                        Notifications
                    </h3>
                    {{-- Notifications for freelancers --}}

                    @if(isset($user->freelancer))
                    @if (isset($user->application))
                    @foreach ($user->application as $application)

                        {{-- Check if job verdict is verdict is 'Approve' and rate client--}}
                        @if($application->gig->job)
                        @if($application->gig->job->rate == 'none' && $application->gig->job->verdict == 'Approve')
                        <p class="green"><span class="bd-text">{{ $application->gig->title }}</span> has been approved.</p>
                        <p><a class="green" href="{{ route('rate.client', ['gig' => $application->gig]) }}">Please rate your experience here</a></p>
                        @endif
                        {{-- Start work after job has been paid --}}
                        @if($application->gig->job->status == 'pending')
                        <p class="green">Begin work for gig <span class="bd-text">{{ $application->gig->title }}</span> <a class="green" href="{{ route('active.job')}}">Here</p></p>
                        @endif
                        @endif
                        {{-- Application status 'Pending' --}}
                        @if($application->status == 'pending')
                        <p class="green">Application for <span class="bd-text">{{ $application->gig->title }}</span> still under review</p>
                        
                        @elseif ($application->status == 'Decline')
                        <p class="red">Application declined</p>
                        @endif
                        
                        {{-- Application status accept and contract is pending--}}
                        @if($application->contract)
                        @if ($application->status == 'Accept' && $application->contract->status == 'pending')
                        <p class="green">Application has been accepted</p>
                        <p class="green">View contract for gig <span class="bd-text">{{ $application->gig->title }}</span> <a class="green" href="{{ route('contracts.view') }}">Here</a></p>
                        @endif
                        @endif

                        @endforeach
                        @else
                        <p>No applications made yet</p>
                        @endif
                        @endif

                    
                    {{-- Notifications for clients --}}
                    @if(isset($user->client))
                    @if(isset($jobs))
                    @foreach($jobs as $job)
                            
                            
                            {{-- Gigs belonging to a client --}}
                            
                            @if($job->status == 'Begin' && $job->paid == $job->price)
                            <p class="">Job <span class="bd-text">{{ $job->gig->title }}</span> has been commenced</p>
                            @elseif($job->status == 'Complete' && $job->verdict == 'pending')
                            <p class=""> Job <span class="bd-text">{{ $job->gig->title }}</span> has been completed</p>
                            <a href="{{ route('approve', ['job' => $job]) }}" style="color:rgb(83, 216, 83);">Check submission<a>
                            @elseif($job->status == 'Complete' && $job->verdict == 'Approve')
                            <p class="">Job <span class="bd-text">{{ $job->gig->title }}</span> has been completed and approved</p>
                            @endif
                            
                    @endforeach
                    @endif
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
    @endsection
