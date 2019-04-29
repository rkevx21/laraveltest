@extends('layouts.app')
@section('content')

<div class="container-fluid">

    {{-- show error message --}}
    @if (count($errors) > 0)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">{{ __('Error:') }}</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- show success message --}}
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{ __('Success:') }}</h4>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    {!! Form::open(array('route' => 'admin.dashboard', 'method' => 'get')) !!}
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-lg-auto col-12 mb-lg-0 mb-3">
                        <div class="row align-items-center justify-content-end">
                            <div class="col">
                                <div class="form-group row mb-0 align-items-center justify-content-end">
                                    {!! Form::label('order', __('Sort by:'), array('class' => 'col-md-auto col-form-label text-md-right')) !!}
                                    <div class="col-md-auto mb-sm-0 mb-3">
                                        {!! Form::select('order_field', [
                                            'id' => 'ID',
                                            'name' => 'Name',
                                            'email' => 'Email',
                                            'gender' => 'Gender'
                                            ], $users['order_field'], ['class' => 'custom-select custom-select-lg', 'id' => 'order']) !!}
                                    </div>
                                    <div class="col-md-auto mb-sm-0 mb-3">
                                        {!! Form::select('order_direction', [
                                            'asc' => 'Ascending',
                                            'desc' => 'Descending',
                                            ], $users['order_direction'], ['class' => 'custom-select custom-select-lg', 'id' => 'order-direction']) !!}
                                    </div>
                                    <div class="col-md-auto text-sm-left text-right">
                                        {!! Form::button('Sort', ['class' => 'btn btn-secondary btn-lg', 'type' => 'submit', 'title' => 'Sort', 'id' => 'sort']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-auto col-12">
                        <div class="row align-items-center justify-content-end">
                            <div class="col">
                                <div class="input-group mb-0">
                                    {!! Form::text('s', $users['s'], [
                                        'class' => 'form-control form-control-lg',
                                        'placeholder' => 'Search...',
                                        'aria-label' => 'Search...',
                                        'aria-describedby' => 'button-addon2',
                                        'id' => 'search',
                                        ]) !!}
                                    <div class="input-group-append">
                                        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', [
                                            'class' => 'btn btn-secondary btn-lg',
                                            'id' => 'search_text',
                                            'type' => 'submit',
                                            'title' => 'Search',
                                            ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    {!! Form::close() !!}

    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                <div class="card-header">Admin : Registered Users</div>

                {{-- <div class="card-body"> --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Gender</th>
                                <th>Education</th>
                                <th>Address</th>
								<th>Description</th>
                                <th>Action</th>
							</thead>					
							<tbody>
								@foreach ($users['users'] as $user)
									<tr>
										<th>{{ $user->id }}</th>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->gender }}</td>
                                        <td>{{ $user->education }}</td>
                                        <td>{{ $user->address }}</td>
										<td>{{ $user->description }}</td>
                                        <td>

                                            <button class="btn btn-primary edit-user" id="edit_{{ $user->id }}" data-action="{{ route('admin.profile.update', [$user->id]) }}" data-user="{{ json_encode($user) }}" data-toggle="modal" data-target="#editUser">Edit
                                            </button>

                                            <button class="btn btn-danger delete-user" id="del_{{ $user->id }}" data-action="{{ route('admin.profile.delete', [$user->id]) }}" data-user="{{ json_encode($user) }}" data-toggle="modal" data-target="#deleteUser">Delete</button>


                                            <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
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
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="_method" value="DELETE" id="{{ $user->id }}">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-primary"id="del_confirm_{{ $user->id }}">Yes</button>
                                                                {{-- <button type="submit" class="btn btn-danger" id="del_{{ $user->id }}" value="Delete">Delete</button> --}}
                                                            </div>
                                                        </form>
                                                  {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary" id="userDeleteFormSubmit">Yes</button>
                                                  </div> --}}                             
                                                </div>
                                              </div>
                                            </div>  
                                            {{-- <form action="{{ route('admin.profile.delete', [$user->id]) }}" method="POST" class="d-inline-block" id="{{ $user->id }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" id="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger" id="del_{{ $user->id }}" value="Delete">Delete</button>
                                            </form> --}}
                                        </td>
									</tr>
								@endforeach
							</tbody>
						</table> 
                    </div>
        </div>
        
        <div class="row text-center">
            {{ $users['users']->links() }}
        </div>

    </div>
@endsection
