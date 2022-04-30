@extends('layouts.auth-master')
@section('content')
    <div class="users-list">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td class="u-fname">{{$user->fname . ' ' . $user->lname}}</td>
                <td class="u-lname">{{$user->email}}</td>
                <td class="u-email"><a href="#">Edit</a></td>
            </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@endsection
