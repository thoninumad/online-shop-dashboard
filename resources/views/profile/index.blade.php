@extends('layouts.global')

@section('title') My Profile @endsection

@section('content')

<div class="col-md-8">
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <b>Name : </b><br>
            {{$user->name}}
            <br><br>

            @if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="128px"/>
            @else
                No avatar
            @endif

            <br><br>
            <b>Username : </b><br>
            {{$user->username}}

            <br><br>
            <b>Phone Number : </b><br>
            @if($user->phone)
                {{$user->phone}}
            @endif

            <br><br>
            <b>Address : </b><br>
            @if($user->address)
                {{$user->address}}
            @endif

            <br><br>
            <b>Roles : </b><br>
            @foreach(json_decode($user->roles) as $role)
                &middot; {{$role}} <br>
            @endforeach

            <br>
            <b>Email : </b><br>
            {{$user->email}}
            <br><br>

            <a class="btn btn-info text-white btn-sm" href="{{route('profile.edit')}}">Edit Profile</a>
            <a class="btn btn-warning text-white btn-sm" href="{{route('profile.change-password')}}">Change Password</a>
        </div>
    </div>
  </div>

@endsection
