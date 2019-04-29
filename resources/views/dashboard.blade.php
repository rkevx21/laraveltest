@extends('layouts.app')

@section('content')
<div class="container-fluid">

	{!! Form::open(array('route' => 'dashboard', 'method' => 'get')) !!}
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
                <div class="card-header">Registered Users</div>

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
</div>
@endsection
