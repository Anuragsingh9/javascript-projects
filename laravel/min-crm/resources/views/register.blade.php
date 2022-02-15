@extends('layouts.master')
@section('content')
    <div class="container company-signin" >
            <div class="register-form" >
                <form method="post" action="{{route('reg-step2')}}">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <ul>
                                    <li>{{$error}}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col">
                            <p class="reg-desc">Register to your Company</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="fname" placeholder="First name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="lname" placeholder="Last name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" class="form-control reg-btn" value="REGISTER">
                        </div>
                    </div>
                        <p>Already have an account? <b><a href="{{route('index')}}">Login</a></b></p>
                </form>
            </div>
    </div>
@endsection
