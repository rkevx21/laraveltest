<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/scripts.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" id="login" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" id="register" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard') }}" id="dashboard">
                                        Dashboard
                                    </a>

{{--                                     <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">
                                        Profile
                                    </a> --}}

                                    <a class="dropdown-item" href="{{ route('profile') }}" id="profile">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" id="logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <!-- Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="form-group row">
                            <label for="modalName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="modalName" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalEmail" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="modalEmail" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalGender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}
                            </label>

                            <div class="col-md-6">

                                <select id="modalGender" class="form-control" name="gender" value="{{ old('gender') }}" required autofocus>
                                    {{-- <option>Please Select</option> --}}
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalEducation" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}
                            </label>

                            <div class="col-md-6">

                                <select id="modalEducation" class="form-control" name="education" value="{{ old('education') }}" required autofocus>
                                    {{-- <option>Please Select</option> --}}
                                    <option value='Elementary'>Elementary</option>
                                    <option value='High School'>High School</option>
                                    <option value='College'>College</option>
                                    <option value='Master'>Master</option>
                                    <option value='Professional Doctorate'>Professional Doctorate</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalAddress" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="modalAddress" type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}
                            </label>

                            <div class="col-md-6">
                                <textarea id="modalDescription" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>
                                </textarea>
                            </div>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="userEditFormSubmit">Save</button>
                  </div>
                </div>
              </div>
            </div>

{{--             <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> 
                  <div class="modal-body">Are you sure you want to delete?</div>
                                                              <form action="{{ route('admin.profile.delete', [$user->id]) }}" method="POST" class="d-inline-block" id="{{ $user->id }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" id="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger" id="del_{{ $user->id }}" value="Delete">Delete</button>
                                            </form>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="userDeleteFormSubmit">Yes</button>
                  </div>                             
                </div>
              </div>
            </div>   --}}

        </main>
    </div>
</body>
</html>
