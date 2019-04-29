@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

{{--                     <div class="form-group row">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar :</label>

                        <div class="col-md-6">
                            <img class="rounded-circle" width="150" height="150" src="/storage/profile_images/{{ $user->avatar}}" />
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name :</label>

                        <div class="col-md-6">
                            <label for="name" class="col-form-label">{{ $user->name }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address :</label>

                        <div class="col-md-6">
                            <label for="email" class="col-form-label">{{ $user->email }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">Gender :</label>

                        <div class="col-md-6">
                            <label for="gender" class="col-form-label">{{ $user->gender }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="education" class="col-md-4 col-form-label text-md-right">Education :</label>

                        <div class="col-md-6">
                            <label for="education" class="col-form-label">{{ $user->education }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">Address :</label>

                        <div class="col-md-6">
                            <label for="address" class="col-form-label">{{ $user->address }}</label>
{{--                             <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe width="300" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $user->address_map }}&t=k&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                    </iframe>
                                </div>
                                <style>.mapouter{text-align:right;height:300px;width:300px;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:300px;}
                                </style>
                            </div> --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description :</label>

                        <div class="col-md-6">
                            <label for="description" class="col-form-label">{{ $user->description }}</label>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('profile.edit', [$user->id]) }}" class="btn btn-primary" id="btnEdit">Edit</a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
