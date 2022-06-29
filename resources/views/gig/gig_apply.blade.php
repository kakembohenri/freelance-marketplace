@extends('layouts.base')

@section('content')
    @if (session('contract'))
        <span class="help-block success">
            <small>{{ session('contract') }}</small>
        </span>
    @endif
    <div class="home-main">
        <h2 id="home-title">Apply for gig: <strong>"{{ $gig->title }}"</strong></h2>
        <div class="contract-container">
            <div class="contract-reciever">
                <div class="reciever-img">
                    <img src="{{ asset('img/'. $gig->avatar) }}" alt="gig avatar">
                </div>
                <span>{{ $gig->title }}</span>
            </div>
            <div class="contract-items">
                <form action="{{ route('apply', ['gig' => $gig]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="file" name="proposal">
                    <button type="submit" class="submit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection