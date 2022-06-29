@extends('layouts.base')

@section('content')

            @if (session('create_gig'))
                <div id="notification" class="notification">
                    <p>{{ session('create_gig') }}</p>
                </div>
            @endif
            @if (session('gig_updated'))
            <div id="notification" class="notification notification-update">
                <p>{{ session('gig_updated') }}</p>
            </div>
            @endif
            @if (session('gig_deleted'))
            <div id="notification" class="notification-del">
                <p>{{ session('gig_deleted') }}</p>
            </div>
            @endif
        <div class="home-tables">
            @if($gigs->count() > 0)
            <h2 id="home-title">My gigs</h2>
            @foreach($gigs as $gig)
            <div class="table-box">
                <div class="table-row table-head">
                    <div class="table-cell title-cell">
                        <span>Title</span>
                    </div>
                    <div class="table-cell">
                        <span>Price (shs)</span>
                    </div>
                    <div class="table-cell">
                        <span>Status</span>
                    </div>
                    <div class="table-cell">
                        <span>Bids</span>
                    </div>
                    <div class="table-cell">
                        <span>Created at</span>
                    </div>
                    <div class="table-cell">
                        <span>Duration</span>
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell title-cell">
                        <span>{{ $gig->title }}</span>
                    </div>
                    <div class="table-cell">
                        <span>{{ $gig->price }}</span>
                    </div>
                    <div class="table-cell">
                        <span>{{ $gig->status }}</span>
                    </div>
                    <div class="table-cell">
                        <span><a href="{{ route('view.applications', ['gig' => $gig]) }}">{{ $gig->application->count() }}</a></span>
                    </div>
                    <div class="table-cell">
                        <span>{{ $gig->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="table-cell last-cell">
                        <span>{{ $gig->duration }}</span>
                    </div>
                </div>
                <div class="table-actions">
                    <div class="table-cell">
                        <span>
                            <form action="{{ route('update.gig', ['gig' => $gig]) }}" method="get">
                                @csrf
                                <button type="submit" class="update">
                                    Update
                                </button>
                            </form>
                        </span>
                    </div>
                    <div class="table-cell">
                        <span>
                            <form action="{{ route('delete.gig', ['gig' => $gig]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">
                                    Delete
                                </button>
                            </form>
                        </span>
                    </div>
                </div> 
            </div>
            @endforeach
            @else
            <h3>You havent created any gigs yet</h3>
            @endif
        </div>
    @endsection