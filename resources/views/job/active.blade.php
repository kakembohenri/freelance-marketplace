@extends('layouts.base')

@section('content')
<style>
.home-tables{
    left: 5%;
}

.title-cell span{
    width:20rem;
}

form input[type="file"]{
    box-shadow: none;
}
</style>
<div class="backdrop"></div>
    @if (session('completed'))
    <div id="notification" class="notification">
        <p>{{ session('completed') }}</p>
    </div>
    @endif
    @if (session('begin'))
    <div id="notification" class="notification">
        <p>{{ session('begin') }}</p>
    </div>
    @endif
    @if (session('incomplete'))
    <div id="notification" class="notification">
        <p>{{ session('incomplete') }}</p>
    </div>
    @endif
    <div class="home-main home-tables">
        <h2 id="home-title">Active jobs</h2>
        @if($jobs->count() != 0)
        @foreach($jobs as $job)
        @if($job->verdict != 'Approve')
        <div class="table-box">
            <div class="table-row table-head">
                <div class="table-cell title-cell">
                    <span>Title</span>
                </div>
                <div class="table-cell">
                    <span>Price (shs)</span>
                </div>
                <div class="table-cell">
                    <span>Paid (shs)</span>
                </div>
                <div class="table-cell">
                    <span>Time</span>
                </div>
                <div class="table-cell">
                    <span>Status</span>
                </div>
                <div class="table-cell">
                    <span>Verdict</span>
                </div>
                @if($job->status == 'Complete')
                @elseif($job->status == 'Begin')
                <div class="table-cell">
                    <span>Complete</span>
                </div>
                @endif
                @if($job->status == 'pending')
                <div class="table-cell">
                    <span>Begin</span>
                </div>
                @endif
            </div>
            <div class="table-row">
                <div class="table-cell title-cell">
                    <span>{{ $job->gig->title }}</span>
                </div>
                <div class="table-cell">
                    <span>{{ $job->price }}</span>
                </div>
                <div class="table-cell">
                    <span>{{ $job->paid }}</span>
                </div>
                <div class="table-cell">
                    <span>{{ $job->gig->duration }}</span>
                </div>
                <div class="table-cell">
                    @if($job->status == 'pending')
                    <span>{{ $job->status }}<i id="spinner" class="fab fas fa-spinner"></i></span>
                    @else
                    <span>{{ $job->status }}</span>
                    @endif
                </div>
                <div class="table-cell">
                    @if($job->verdict == 'pending')
                    <span>{{ $job->verdict }}<i id="spinner" class="fab fas fa-spinner"></i></span>
                    @else
                    <span>{{ $job->verdict }}</span>
                    @endif
                </div>
                @if($job->status == 'Complete')
                @else
                @if($job->status == 'pending' && $job->paid != 0)
                <div class="table-cell">
                    <span>
                        <form action="{{ route('begin', ['job' => $job]) }}" method="post">
                            @csrf
                        <button type="submit" id="begin" class="upload" name="begin" value="Begin">
                            Begin
                        </button>
                    </form>
                    {{-- @elseif($job->status == 'Begin')
                    <p class="begin">Job began!</p>
                    @endif --}}
                    </span>
                </div>
                @endif
                @endif
                @if($job->status == 'Begin')
                <div class="table-cell last-cell">
                    <span>
                        <button type="button" id="complete" class="submit">
                            Complete
                        </button>
                    </span>
                </div>
                @else
                @endif
            </div>
        </div>
        <div class="table-notifications">
            @if($job->status == 'Complete' && $job->verdict == 'Approved')
             <p>Congratulations your account will be credited with the funds due from this piece of work</p>
             @elseif($job->status == 'Complete' && $job->verdict == 'pending')
             <p class="blue">Wait for the client to approve your work please</p>
             @elseif($job->status == 'Complete' && $job->verdict == 'Declined')
             <p class="red"> The client apparently has declined your work. Please get in contact with your client and look for a way forward</p>
            @endif
        </div>
        <div class="popup">
            <h3>Complete Job</h3>
            <form action="{{ route('job.complete', ['job' => $job]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" placeholder="Paste link to work">
                <small>* this may be optional depending on what your client wants</small>
                <input type="file" name="file" required>
                <input type="submit" name="submit" value="Complete" class="submit">
            </form>
        </div>
        @endif
        @endforeach
    </div>
    @else
    <p>No active jobs yet</p>
    @endif
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>
@endsection