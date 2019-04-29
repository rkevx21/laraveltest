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

                   <div class="form-group row">
                        {!! Form::label('name','Name :',['class'=>'col-md-4 col-form-label text-md-right']) !!}

                        <div class="col-md-6">
                        {!! Form::label('name',$user->name,['class'=>'col-form-label']) !!}</div>
                    </div>      

                   <div class="form-group row">
                        {!! Form::label('email','E-Mail Address :',['class'=>'col-md-4 col-form-label text-md-right']) !!}

                        <div class="col-md-6">
                        {!! Form::label('email',$user->email,['class'=>'col-form-label']) !!}</div>
                    </div> 

                   <div class="form-group row">
                        {!! Form::label('gender','Gender :',['class'=>'col-md-4 col-form-label text-md-right']) !!}

                        <div class="col-md-6">
                        {!! Form::label('gender',$user->gender,['class'=>'col-form-label']) !!}</div>
                    </div> 

                   <div class="form-group row">
                        {!! Form::label('description','Description :',['class'=>'col-md-4 col-form-label text-md-right']) !!}

                        <div class="col-md-6">
                        {!! Form::label('description',$user->description,['class'=>'col-form-label']) !!}</div>
                    </div> 

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('profile.edit', [$user->id]) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
