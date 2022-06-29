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

/*  */
.actions{
    display: flex;
    flex-direction: row;
}
    input[value="Approve"]{
        background: rgb(83, 216, 83);
    }

    input[value="Approve"]:hover,
    input[value="Approve"]:active {
        background: green;
    }

    .success{
        background: rgb(83, 216, 83);
        text-align: center;
    }

    .success > small {
        color: white;
    }

    textarea{
        padding: 0.5rem;
        width: 35rem;
        height: 15rem;
        resize: none;
    }

    input.rate{
        background: rgb(83, 216, 83);
    }

    input.rate:hover,
    input.rate:active {
        background: green;
    }

    .error{
        background: crimson;
        text-align: center;
        width: 50%;
    }

    .error > strong{
        color: white;
    }
    </style>
    <h1 style="margin-bottom: 30px">Thanks for rating</h1>
        @if (session('rate'))
            <span class="help-block success">
                <small>{{ session('rate') }}</small>
            </span>
        @endif 
    
@endsection