@extends('layouts.base')

@section('content')
<style>
.popup-pay{
    width: fit-content;
    left: 50%;
}

select{
    width: 20%;
}

h4{
    margin: 0.5rem 0rem;
}

.mobile-choice{
    display: flex;
    align-items: center;
}

.popup-pay form input[type="checkbox"]{
    box-shadow: none;
    margin: auto 0.3rem;
    margin-right: 1rem;
}

.mobile-others{
    display:flex;
    flex-direction: column;
}

.popup-pay form input[type="number"]{
height: 2rem;
}

.popup-pay form input[type="password"]{
    height: 2rem;
}
</style>
@if (session('contract'))
        <div id="notification" class="notification">
            <p>{{ session('contract') }}</p>
        </div>
    @endif
    @if (session('no_match'))
        <div id="notification" class="notification">
            <p>{{ session('no_match') }}</p>
        </div>
    @endif
    @if (session('paid'))
        <div id="notification" class="notification">
            <p>{{ session('paid') }}</p>
        </div>
    @endif
<div class="backdrop"></div> 
<div class="home-tables">
            @if($gig->application->count() == 0)
    <h2 id="home-title">No applications for Gig: <strong>{{ $gig->title }}</strong></h2>
    @else
            <h2 id="home-title">Application for gig: <strong>{{ $gig->title }}</strong></h2>
        @foreach($gig->application as $application)
        <div class="table-box">
            <div class="table-row table-head">
                <div class="table-cell title-cell">
                    <span>From</span>
                </div>
                <div class="table-cell">
                    <span>Download document</span>
                </div>
                <div class="table-cell">
                    @if($application->status == 'pending')
                    <span>Accept</span>
                    @endif
                    @if($application->status == 'Accept' && empty($application->contract))
                    <span>Offer contract</span>
                    @endif
                    @if($application->contract)
                    @if($application->contract->status == 'pending')
                    <span>Contract status</span>
                    @endif
                    @if($application->contract->status == 'Accept')
                    @if($application->gig->job->paid == 0)
                    <span>Contract status</span>
                    @endif
                    @endif
                    @endif
                    @if(isset($application->gig->job))
                    @if($application->gig->job->verdict == 'Approve')
                    <span>Contract status</span>
                    @endif
                    @endif
                </div>
                @if($application->status == 'pending')
                <div class="table-cell">
                    <span>Decline</span>
                </div>
                @else
                @endif
            </div>
            <div class="table-row">
                <div class="table-cell title-cell">
                    <span>{{ $application->user->username }}</span>
                </div>
                <div class="table-cell">
                    <span><a class="download" href="{{ route('download', ['application' => $application]) }}">
                        Download
                    </a></span>
                </div>
                
            <div class="table-cell">
                <span>
                    
                    {{-- Application status 'pending' --}}
                    @if($application->status == 'pending')
                    <form action="{{ route('accept.application', ['application' => $application]) }}" method="post">
                        @csrf
                        <button type="submit" name="accepted" class="update" value="Accept">
                            Accept
                        </button>
                    </form>
                    {{-- Application accepted but a contract hasnt yet been offered --}}
                    @elseif($application->status == 'Accept' && empty($application->contract))
                    <a class="offer-contract" href="{{ route('contract', ['application' => $application]) }}">Offer contract</a>
                    @endif
                    @if($application->contract)
                    @if($application->contract->status == 'pending')
                    <p class="contract-pending">Contract pending <i id="spinner" class="fab fas fa-spinner"></i></p>
                    @endif
                    @if($application->contract->status == 'Accept')
                    @if($application->gig->job->paid == 0)
                    {{-- {{ route('payments', ['job' => $application->gig->job]) }} --}}
                    <a id="fund" class="fund-btn" href="#" class="green">Fund</a>
                    @endif
                    @endif
                    @endif
                    @if(isset($application->gig->job))
                    @if($application->gig->job->verdict == 'Approve')
                    <p class="approve">Gig was completed</p>
                    @endif
                    @endif
                </span>
            </div>
            @if($application->status == 'pending')
            <div class="table-cell last-cell">
                <span>
                    @if($application->status != 'Accept')
                    <form action="{{ route('decline.application', ['application' => $application]) }}" method="post">
                        @csrf
                        <button type="submit" name="declined" value="Decline" class="delete">
                            Decline
                        </button>
                    </form>
                    @elseif($application->status == 'Decline')
                    <p id="declined">Declined!</p>
                    @endif
                </span>
            </div>
            @else
            @endif
        </div>
        <div class="popup popup-pay">
            <h3>Fund Job: "{{ $application->gig->title }}"</h3>
            @if($application->gig->job)
            <form action="{{ route('pay', ['job' => $application->gig->job]) }}" method="post">
                @csrf
                <h4>Powered by mobile money</h4>
                <label for="">
                    Choose Mobile money provider:
                </label>
                {{-- <select name="mobile-money" id="">
                    <option value="airtel">Airtel</option>
                    <option value="mtn">MTN</option>
                </select> --}}
                <div class="mobile-choice">
                    <label for="">
                        Airtel
                    </label>
                    <input type="checkbox" value="airtel">
                    <label for="">
                        MTN
                    </label>
                    <input type="checkbox" value="mtn">
                </div>
                <div class="mobile-others">
                    <p>Amount due: <strong>{{ $application->gig->price }}</strong></p>
                        <br /><br />
                        <input type="number" placeholder="Phone number" required>
                        <br /><br />
                        <input type="number" name="amount" placeholder="Amount" required>
                    <br /><br />
                    <input type="password" placeholder="Pin" required>
                    <br /><br />
                    <input type="submit" value="Pay" id="mobile-btn" class="submit">
                </div>
                
            </form>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>  
@endsection