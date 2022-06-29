@extends('layouts.base')

@section('content')
<style>
    p{
        margin: 0.5rem 0rem;
    }
</style>
@if (session('contract_accept'))
<div id="notification" class="notification">
<p>{{ session('contract_accept') }}</p>
</div>
@endif
@if (session('contract_declined'))   
<div id="notification" class="notification">
    <p>{{ session('contract_declined') }}</p>
</div>
@endif
<div class="home-main">
    <h2 id="home-title">My contracts</h2>
    @if($applications)
        @foreach($applications as $application)
        @if($application->contract)
        {{-- @if($application->contract->status == 'pending') --}}
        <div class="home-container">
                <div class="home-container-items">
                    <div class="home-pic-and-title">
                        <div class="pic-container">
                            {{-- Image to be fetched from the db --}}
                                <img class="profile-pic" src="{{asset('img/' . $application->gig->avatar)}}">
                        </div>
                        <h2>
                            {{ $application->gig->title }}
                        </h2>
                    </div>
                    <div class="contract-items ">
                        <a class="contract-link" href="{{ route('download.contract', ['contract' => $application->contract]) }}">Download contract</a>
                        {{-- Contract pending --}}
                        @if($application->contract->status == 'pending')
                    <div class="contract-forms">
                        <form action="{{ route('contract.accept.freelancer', ['contract' => $application->contract]) }}" method="post">
                            @csrf
                            <input type="submit" name="accepted" value="Accept" />
                        </form>
                        <form action="{{ route('contract.decline.freelancer', ['contract' => $application->contract]) }}" method="post">
                            @csrf
                            <input type="submit" name="declined" value="Decline" />
                        </form>
                    </div>
                    
                    {{-- Contract is declined --}}
                @elseif($application->contract->status == 'Decline')
                 <p>Contract declined! Contact your client if you wish to discuss new terms</p>
                 {{-- Contract is accepted and job not paid for --}}
                @endif
                @if($application->contract->status == 'Accept' )
                @if($application->gig->job)
                @if($application->gig->job->paid == 0)
                <p class="wait">Wait for the client to fund this job before you can start work</p>
                {{-- Contract is accepted and job paid for --}}
                @endif
                @endif
                {{-- && $application->gig->job->status == 'pending' --}}
                @if($application->gig->job->paid != 0 && $application->gig->job->status == 'pending' )
                 <p class="blue">Gig has been funded therefore you can commence with the work</p>&nbsp;&nbsp;&nbsp;
                 <a class="green" href="{{ route('active.job') }}">Get to work</a>
                @endif
                @endif
                    </div>
                
            
                </div>  
               
        </div>
        {{-- @endif --}}
        @endif           
    @endforeach
    @endif
        </div> 
@endsection