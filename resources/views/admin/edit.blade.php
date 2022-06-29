@extends('layouts.base')

@section('content')
<style>
    .container{
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .admin-container{
        display: flex;
        width: 100%;
    }

    .admins{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .admin{
        height: 20rem;
        width: 20rem;
        padding: 0.5rem;
        margin: 1rem;
        border: 0.2rem solid black;
    }

    .admin-actions{
        display: flex;
        flex-direction: row;
    }

    input[value='Update']{
        background: rgb(83, 216, 83);
        color: white;
        cursor: pointer;
        transition: 0.2s ease-in;
    }

    input[value='Update']:hover,
    input[value='Update']:active {
        background: green;
    }
</style>
<h1>Edit admin users</h1>
@if (session('admin_deleted'))
    <span class="help-block">
        <small>{{ session('admin_deleted') }}</small>
    </span>
@endif
@if (session('admin_updated'))
    <span class="help-block">
        <small>{{ session('admin_updated') }}</small>
    </span>
@endif
<div class="admin-container">
    @foreach($admins as $admin)
    <div class="admins">
        <div class="admin">
            <p>{{ $admin->user->username }}</p>
            <div class="admin-actions">
                <form action="{{ route('admin.update', ['admin' => $admin]) }}" method="get">
                    @csrf
                    <input type="submit" value="Update" />
                </form>
                <form action="{{ route('admin.delete', ['admin' => $admin]) }}" method="post">
                    @csrf
                    <input type="submit" value="Delete" />
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection