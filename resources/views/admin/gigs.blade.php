@extends('layouts.base')

@section('content')
<style>
   input.form-control{
       padding: 0.5rem;
       border-radius: 0.5rem;
       border: 0.1rem solid crimson;
       outline: none;
       margin: 1rem 0rem;
   } 

   input.form-control:focus{
       border: 0.1rem solid red;
   }

   button[value="Ban"]{
       cursor:pointer;
       background: crimson;
       color: rgba(0,0,0,0.7);
   }

   button[value="Ban"]:hover{
       background: red;
       color: white;
   }
</style>
@if(session('banned'))
<div id="notification" class="notification">
    <p>{{ session('banned') }}</p>
</div>
@endif
{{-- style="padding-right: 200px" --}}
<div class="home-main">
<h2 id="home-title">Search gigs</h2>
<form action="{{ route('gig.ban') }}" method="get">
<input type="text" name="search" class="form-control" value="{{ request()->query('search') }}" placeholder="Find gigs...">
</form>

    {{-- @if($search) --}}
    @if($gigs->count())
    @if(request()->query('search'))
    <h3> Search results for <strong>{{ request()->query('search') }}</strong></h3>
    @foreach($gigs as $gig)
    <div class="home-container">
        <div class="home-container-items">
            @if(isset($gig->ban))
            <div class="bg-ban">
                <h4>Gig has been banned!</h4>
            </div>
            @else
            @endif
            <div class="home-pic-and-title">
                <div class="pic-container">
                    <img src="{{ asset('img/'. $gig->avatar) }}" alt="">
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
                    <p>{{ $gig->user->username }}</p>
                </div>
                @if($gig->ban)
                <p>Gig was banned</p>
                @else
                <form action="{{ route('ban', ['gig' => $gig]) }}" method="post" class="apply">
                    @csrf
                    <button type="submit" value="Ban">
                        Ban
                    </button>
                </form>
                @endif
                <span id="price">Price: {{ $gig->price }} shs</span>
                    <span id="date-posted">Posted: {{ $gig->created_at->diffForHumans() }}
                    </span>
            </div>
        </div>
    @endforeach
    @endif
    @endif
    {{-- @endif --}}
    </div>
    
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection