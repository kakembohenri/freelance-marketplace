@extends('layouts.base')

@section('content')

    @if (session('admin_created'))
    <div id="notification" class="notification">
        <p>{{ session('admin_created') }}</p>
    </div>
   @endif
    <div class="home-main">
        <h2 id="home-title">Admin dashboard</h2>
        <div class="dashboard-container">
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Users</p>
                    <span>{{ $users->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/user.png') }}">
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Clients</p>
                    <span>{{ $clients->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/client.png') }}">
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Freelancers</p>
                    <span>{{ $freelancers->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/freelancer.png') }}">
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Gigs created</p>
                    <span>{{ $gig->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/gigs.png') }}">
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Gigs banned</p>
                    <span>{{ $ban->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/illegal.png') }}">
                </div>
            </div>
            <div class="dashboard-item">
                <div class="dashboard-item_left">
                    <p>Gigs completed</p>
                    <span>{{ $jobs->count() }}</span>
                </div>
                <div class="dashboard-item_img">
                    <img src="{{ asset('images/percentage.png') }}">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
