@extends('layouts.base')

@section('content')
<style>
    .contract-forms form input[name="approve"]{
        width: fit-content;
        padding:0.5rem 0.8rem;
        background: skyblue;
        border: none;
        cursor: pointer;
        color: white;
    }

    .contract-forms form input[name="approve"]:hover{
        background: blue;
    }

    .contract-forms form input[name="decline"]{
        width: fit-content;
        padding:0.5rem 0.8rem;
        background: crimson;
        border: none;
        cursor: pointer;
        color: white;
        margin-left: 0.5rem;
    }

    .contract-forms form input[name="decline"]:hover{
        background: red;
    }

    .review_exp{
        margin: 1rem 0rem;
    }

    textarea{
        padding: 0.5rem; 
        margin-bottom: 0.5rem;
    }

    input[class="rate"]{
        margin: 0.5rem 0rem;
        padding: 0.5rem 0.8rem;
        color: white;
        background: skyblue;
        cursor: pointer;
        border: none;
    }

    input[class="rate"]:hover{
        background: blue;
    }
</style>
@if (session('approved'))
    <div id="notification" class="notification">
        <p>{{ session('approved') }}</p>
    </div>
@endif 
        @if (session('rate'))
        <div id="notification" class="notification">
            <p>{{ session('rate') }}</p>
        </div>
        @endif 
<div class="home-main">
    @if($job->count() > 0)
    <h2 id="home-title">Approve job: <strong>"{{ $job->gig->title }}"</strong></h2>
    <div class="home-container">
        <div class="home-container-items">
            <div class="home-pic-and-title">
                <div class="pic-container">
                    {{-- Image to be fetched from the db --}}
                        <img class="profile-pic" src="{{asset('img/' . $job->gig->avatar)}}">
                </div>
                <h2>
                    {{ $job->gig->title }}
                </h2>
            </div>
            <div class="contract-items ">
                <a class="contract-link" href="{{ route('download.work', ['job' => $job]) }}">Download work</a>
                {{-- Contract pending --}}

                @if($job->verdict == 'pending')
            <div class="contract-forms">
                {{-- Approve work --}}
                <form action="{{ route('approve.work', ['job' => $job]) }}" method="post">
                    @csrf
                    <input type="submit" name="approve" value="Approve" />
                </form>
                {{-- Decline work --}}
                <form action="" method="post">
                    @csrf
                    <input type="submit" name="decline" value="Decline" />
                </form>
            </div>
            @endif
        </div>

    <div>
        @if($job->verdict == 'Approve')
        <p>You have approved this work and the funds shall be transfered to the freelancer</p>
        @elseif($job->verdict == 'Decline')
        <p>You have declined this work</p>
        @endif
    </div>

    {{-- Reviews --}}
    <form class="review_exp" action="{{ route('review', ['user' => $job->user_id]) }}" method="post">
        @csrf
        <h3>Please rate your experience below</h3>
        <br />
        <textarea name="body" placeholder="Tell us about your experience"></textarea>
            @error('body')
            <span class="form-input_error">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        <br />
        Rate your experience on a scale from 1-5
        <br />
        1:<input type="radio" name="rating" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
        2:<input type="radio" name="rating" value="2" />&nbsp;&nbsp;&nbsp;&nbsp;
        3:<input type="radio" name="rating" value="3" />&nbsp;&nbsp;&nbsp;&nbsp;
        4:<input type="radio" name="rating" value="4" />&nbsp;&nbsp;&nbsp;&nbsp;
        5:<input type="radio" name="rating" value="5" />
            @error('rating')
            <span class="form-input_error">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        <br />
        <input class="rate" type="submit"/>
    </form>
    {{-- @endif --}}
    @else
    <h2 id="home-title">No jobs to approve</h2>
    @endif
</div>
@endsection