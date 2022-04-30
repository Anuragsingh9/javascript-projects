    <header class="p-1 bg-dark text-white">
        <div class="container">
{{--                <img src="{{ asset('images/logo.svg') }}" alt="" width="100px" height="60px" style="color: white">--}}
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container-fluid">
                    <img src="{{ asset('images/logo.svg') }}" alt="" width="100px" height="40px" >
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users-list')}}">List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dashboard')}}">Profile</a>
                            </li>
                            <li class="nav-item add-user">
                                <a class="nav-link">Add User</a>
                                <ul class="upload-type">
                                    <li><a href="{{route('import-view')}}">Upload File</a></li>
                                    <li><a href="{{route('manually-add-view')}}">Add Manually</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="d-flex">
{{--                            <i class="fa-power-off"></i>--}}
{{--                            <i class="far fa-sign-out-alt"></i>--}}
{{--                            <i class="fa-solid fa-user"></i>--}}
                            <a href="{{route('logout')}}" class="logout"><i class="fa fa-power-off">&nbsp;</i>Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
            </div>
    </header>
