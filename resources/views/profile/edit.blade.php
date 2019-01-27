@extends('layouts.global')

@section('title') Edit Profile @endsection

@section('content')
<div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('profile.update')}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">

        <label for="name">Name</label>
        <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="Full Name" type="text" name="name" id="name" value="{{old('name') ? old('name') : $user->name}}"/>
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        <br>

        <label for="username">Username</label>
        <input class="form-control" placeholder="Username" type="text" name="username" id="username" value="{{$user->username}}" disabled/>
        <br>

        <label for="phone">Phone Number</label>
        <br>
        <input type="number" name="phone" id="phone" placeholder="Phone Number" class="form-control {{$errors->first('phone') ? "is-invalid" : ""}}" value="{{old('phone') ? old('phone') : $user->phone}}">
        <div class="invalid-feedback">
            {{$errors->first('phone')}}
        </div>

        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" placeholder="Address" class="form-control {{$errors->first('address') ? "is-invalid" : ""}}">{{old('address') ? old('address') : $user->address}}</textarea>
        <div class="invalid-feedback">
            {{$errors->first('address')}}
        </div>

        <br>
        <label for="avatar">Avatar Image</label>
        <br>
        Current avatar : <br>
        @if($user->avatar)
            <img src="{{asset('storage/'.$user->avatar)}}" width="120px"/>
            <br>
        @else
            No avatar
        @endif
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-4">

        <label for="email">Email</label>
        <input class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" placeholder="user@mail.com" type="email" name="email" id="email" value="{{$user->email}}" disabled/>
        <div class="invalid-feedback">
            {{$errors->first('email')}}
        </div>
        <br>

        <input class="btn btn-primary" type="submit" value="Save"/>
    </form>

</div>
@endsection
