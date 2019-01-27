@extends('layouts.global')

@section('title') Change Password @endsection

@section('content')
<div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('profile.update-password')}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">

        <label for="password">Current Password</label>
        <input class="form-control {{$errors->first('current_password') ? "is-invalid" : ""}}" placeholder="Current Password" type="password" name="current_password" id="current_password"/>
        <div class="invalid-feedback">
            {{$errors->first('current_password')}}
        </div>
        <br>

        <label for="password">New Password</label>
        <input class="form-control {{$errors->first('new_password') ? "is-invalid" : ""}}" placeholder="New Password" type="password" name="new_password" id="new_password"/>
        <div class="invalid-feedback">
            {{$errors->first('new_password')}}
        </div>
        <br>

        <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="Password Confirmation" type="password" name="password_confirmation" id="password_confirmation"/>
        <div class="invalid-feedback">
            {{$errors->first('password_confirmation')}}
        </div>
        <br>

        <input class="btn btn-primary" type="submit" value="Save"/>
    </form>

</div>
@endsection
