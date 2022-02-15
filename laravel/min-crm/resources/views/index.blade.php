@extends('layouts.master')
@section('content')
    <div class="container company-signin" >
        <form method="post" action="{{route('login')}}">
            @csrf
        <div class="sign-form" >
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <ul>
                            <li>{{$error}}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
            <p class="sign-desc">Sign in to your Company</p>
            <div class="sign-item">
                <label>Enter you email</label>
                <input type="text" name="email" placeholder="your-email">
            </div>
            <div class="sign-item">
                <label>Enter you password</label>
                <input type="text" name="password" placeholder="your-password">
            </div>
            <div class="sign-button">
                <input type="submit" value="LOG IN" >
            </div>
            <p>Forgot your password? <b><a href="">Need Help</a></b></p>
            <p>Want to register with us? <b><a href="{{route('reg-step1')}}">Register Now</a></b></p>
        </div>
        </form>
    </div>
@endsection
