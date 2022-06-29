@extends('layouts.base')

@section('content')
@if (session('contract'))
        <div id="notification" class="notification">
            <strong>{{ session('contract') }}</strong>
        </div>
    @endif
<div class="home-main">
    <h2 id="home-title">Contract offer for <span style="color: crimson;">"{{ $application->user->username }}"</span> for gig <span style="color: crimson;">"{{ $application->gig->title }}"</span></h2>
    <div class="contract-container">
        <div class="contract-reciever">
            <div class="reciever-img">
                <img src="{{ asset('img/'. $application->user->image_path) }}" alt="">
            </div>
            <span>{{ $application->user->username }}</span>
        </div>
        <div class="contract-items">
            <form action="{{ route('contract.submit', ['application' => $application]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="contract" type="file" />
                @error('contract')
                <div class="form-input_error">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <button type="submit" class="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection