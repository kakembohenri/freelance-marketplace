@extends('layouts.base')

@section('content')
<style>
    .messages{
        display: flex;
        align-items: center;
    }

    .messages p {
        color: crimson;
        font-weight: 700;
        margin-left: 0.5rem;
    }

    .contact-btn{
        margin-left: 1rem;
        text-decoration: none;
        color: rgba(0,0,0,0.7);
        background: lightgreen;
        cursor: pointer;
        padding: 0.5rem 0.8rem;
        width: fit-content;
    }

    .contact-btn:hover{
        background: green;
        color: white;
    }

</style>
<div class="home-main">
    <h1 style="margin-bottom: 30px">Previously contacted</h1>
    
    @if($user_from->count() || $user_to->count())

    {{-- If the user is a sender --}}
    @foreach($user_to as $item)

    {{-- Iterate through each user to look for a match with a sender --}}
    @foreach($users as $user)
    @if($user->id == $item["user_from"])
    <div class="panel panel-default">
        <div class="messages">
            <div>
                <img style="height:10rem;" src="{{ asset('img/'. $user->image_path) }}" alt="{{ $user->username }}'s avatar" />
            </div>
            <p>{{ $user->username }}</p>
            <a class="contact-btn" href="{{ route('inbox', $user) }}">Contact</a>
            {{-- <p>{{ $user->username }}</p> --}}
        </div>
    </div>
    @endif
    @endforeach
    @endforeach

    @else
    <div class="panel panel-default">
        <div class="messages">
            <p>You havent been engaged in any conversation yet</p>
        </div>
    </div>
</div>
    @endif
@endsection