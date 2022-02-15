@extends('layouts.auth-master')
@section('content')
    <div class="profile-card">
        <form method="post" action="{{route('update-profile')}}" enctype="multipart/form-data">
            @csrf
            @php($user= \Illuminate\Support\Facades\Auth::user())
            <div class="avatar">
                @if($user['avatar'] = $user['avatar'] ? $user['avatar'] :config('constant.default.images.user_default'))
                @endif
                <img src={{asset('storage/'.$user['avatar'])}}
                      alt="">
                <div class="file-upload">
                    <input type="file" placeholder="none" name="avatar">
                </div>
            </div>
            <div class="profile-field">
                <div class="profile-row">
                    <div class="item"><input class="form-control" name="fname" placeholder="Name"
                                             value="{{$user['fname']}}"></div>
                    <div class="item"><input class="form-control" name="lname" placeholder="Last name"
                                             value="{{$user['lname']}}"></div>
                </div>
                <div class="profile-row">
                    <div class="item"><input class="form-control" name="email" placeholder="Email"
                                             value="{{$user['email']}}"></div>
                    <div class="item"><input class="form-control" name="phone" placeholder="Phone" value=""></div>
                </div>
                <div class="profile-row">
                    <div class="item"><input class="form-control" name="company" placeholder="Company"
                                             value="{{$user['fname']}}"></div>
                    <div class="item"><input class="form-control" name="position" placeholder="Position"
                                             value="{{$user['fname']}}"></div>
                </div>
                <div class="profile-row">
                    <div class="update-btn"><input type="submit" value="UPDATE"></div>
                </div>
            </div>
        </form>
    </div>
@endsection
