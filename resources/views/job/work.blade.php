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

    span.failure{
        width: 60%;
        background: crimson;
    }

    span.failure > small{
        color: white;
        text-align: center;
    }
    </style>
    <h1 style="margin-bottom: 30px">Get started with work</h1>
    {{-- @if (session('contract_accept'))
                        <span class="help-block success">
                            <small>{{ session('contract_accept') }}</small>
                        </span>
        @endif
        @if (session('contract_declined'))
            <span class="help-block failure">
                <small>{{ session('contract_declined') }}</small>
            </span>
        @endif --}}
        
    <div class="panel panel-default">
            {{-- Upload proposal:<input type="file" /> --}}
        <div class="table-actions">
            @if($gig->job->count())
            @if($gig->job->price != $gig->job->paid)
            <p> You will have to wait for for the client to pay before you can do this job! </p>
            @elseif($gig->job[0]->status == 'pending')
                <form action="{{ route('contract.accept.freelancer', ['gig' => $gig]) }}" method="post">
                    @csrf
                    <input type="submit" name="begin" value="Begin" />
                </form>
            @elseif($gig->job[0]->status == 'Begin')
                
                <form action="{{ route('contract.decline.freelancer', ['gig' => $gig]) }}" method="post">
                    @csrf
                    * &nbsp;<input type="text" name="link" placeholder="Link to your work" />
                    <small><li>*If your client requires it then provide it!</li></small>
                    <input type="submit" name="submit" value="Completed" />
                </form>
                <form action="{{ route('contract.decline.freelancer', ['gig' => $gig]) }}" method="post">
                    @csrf
                    <input type="submit" name="stop" value="Stop" />
                </form>
            @endif
            @if($gig->job[0]->status == 'Completed' & $gig->job[0]->verdict == 'Approved')
             <p>Congratulations your account will be credited with the funds due from this piece of work</p>
             @elseif($gig->job[0]->status == 'Completed' & $gig->job[0]->verdict == 'pending')
             <p class="blue">Wait for the client to approve your work please</p>
             @elseif($gig->job[0]->status == 'Completed' & $gig->job[0]->verdict == 'Declined')
             <p class="red"> The client apparently has declined your work. Please get in contact with your client and look for a way forward</p>
            @endif
            
            @else
            <p>You will have to wait for for the client to pay before you can do this job!</p>
            @endif
        </div>  
    </div>
@endsection