@extends('layouts.base')

@section('content')
<style>
    
    .container{
        display: block;
    }

    .table-actions{
        display: flex;
    }

    .table-actions >form {
        padding: 0 1rem;
    }

    input[value="Update"]{
        background: rgb(83, 216, 83);
        transition: 0.3s ease-in;
    }

    input[value="Update"]:hover,
    input[value="Update"]:active {
        background: green;
    }

    form > input{
        margin: 0.5rem;
    }

    form > input[type='url']{
        padding: 0.5rem;
        width: 60%;
    }

    input[name="accepted"]{
        background: rgb(83, 216, 83);
    }

    input[name="accepted"]:hover,
    input[name="accepted"]:active {
        background: green;
    }

    small > i {
        color: crimson;
    }

    /* input[name="declined"]{
        background: crimson;
    }

    input[name="declined"]:hover,
    input[name='declined']:active {
        background: red;
    } */

    p.green + a{
        margin: 0.5rem;
        padding: 0.5rem;
        background:rgb(83, 216, 83);
        text-decoration: none;
        color: white;
        border-radius: 0.5rem;
    }

    p.green + a:hover,
    p.green +a:active{
        background: green;
    }
    .table-actions{
        flex-direction: column;
    }

    span > a{
        background: none;
        color: blue;
    }
    </style>
    {{-- @if($gig->application->count() == 0) --}}
    @if($job)
    <h1 style="margin-bottom: 30px">Job <strong>{{ $job->gig->title }}</strong> needs funding</h1>
    
    {{-- @else --}}
    @if (session('paid'))
                        <span class="help-block success">
                            <small>{{ session('paid') }}</small>
                        </span>
        @endif
    @if($job->paid == 0)
    <div class="panel panel-default">
        <div class="table-actions">
                <p class="green">Title: <strong>{{ $job->gig->title }}</strong></p>
                
                <p class="green">Freelancer: <strong>{{ $job->user->username }}</strong><p>
                <p class="green">Price: <strong>{{ $job->price }}</strong><p>
                <p class="green">Paid: <strong>{{ $job->paid }}</strong><p>
                <form action="{{ route('pay', ['job' => $job]) }}" method="get">
                    @csrf                    
                    <input type="submit" name="accepted" value="Pay" />
                </form>
        </div>  
    </div>
    @else
    <div class="panel panel-default">
        <div class="table-actions">
                <p class="green">Title: <strong>{{ $job->gig->title }}</strong></p>    
                <p class="green">Freelancer: <strong>{{ $job->user->username }}</strong><p>
                <p class="green">You have successfully paid for this gig</p>
                {{-- <span><a href="" class="blue back">Back</a></span> --}}
        </div>  
    </div>
        
    @endif
    
    @endif
@endsection