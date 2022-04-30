@extends('layouts.auth-master')
@section('content')
    <div class="import-section">
        <h4>Add bulk users by uploading CSV file</h4>
        <div class="import-form">
            <form action="{{route('import-user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
{{--                foreach ($errorMsg as $erMsg){--}}
{{--                //                dd($erMsg[0]);--}}
{{--                //            }--}}

                @if ($errorMsg = \Illuminate\Support\Facades\Session::get('errorMsg'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errorMsg as $error)
                                @foreach($error as $msg)
                                    <li>{{ $msg }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    <input type="submit" value="Upload" id="upload-btn">
                </div>
                @if(\Illuminate\Support\Facades\Session::has('usersCount'))
                <div class="record-info">
                    @php($userCount = isset($usersCount) ? $usersCount :0)
                    <span class="total-users-info">Total users create: {{$userCount}}</span>
                </div>
                @endif
            </form>
        </div>
    </div>
@endsection

