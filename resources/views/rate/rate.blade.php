@extends('layouts.base')

@section('content')
<style>
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
@if (session('rate'))
    <div id="notification" class="notification">
        <p>{{ session('rate') }}</p>
    </div>
@endif 
<div class="home-main">
    <h2 id="home-title">Rate client: <strong>"{{ $gig->user->username }}"</strong></h2>
        

    {{-- Reviews --}}
    <form class="review_exp" action="{{ route('post.rating', ['gig' => $gig]) }}" method="post">
        @csrf
        <textarea name="body" placeholder="Tell us about your experience"></textarea>
        @error('body')
        <span class="form-input_error"">
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
@endsection