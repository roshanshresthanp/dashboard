@extends('admin.layouts.app')

@section('title', 'Role')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('roles.index')}}" class="text-active">Role</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('roles.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('roles.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus">
	Add Role
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Employees</h3>
				</div>
			</div>
			<!-- /.card-header -->

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-error" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="main" class="checkbox"></th>
                        <th>Role Name</th>
                        {{-- <th>Branch</th> --}}
                        {{-- <th>Contact</th>
                        <th>Second Contact</th>
                        <th>Email</th>
                        <th>Status</th> --}}
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $employee)
                        <tr>
                            {{-- <td>{{ is_null($employee->user) ? 'N/A' : $employee->user->name }}</td>
                            <td>{{ is_null($employee->employeeRole) ? 'N/A' : $employee->employeeRole->name }}</td>
                            <td>{{ is_null($employee->user) ? 'N/A' : $employee->user->phone }}</td>
                            <td>{{ is_null($employee->user) ? 'N/A' : $employee->user->contact2 }}</td>
                            <td>{{ is_null($employee->user) ? 'N/A' : $employee->user->email }}</td>
                            <td>{!! $employee->status_badge !!}</td> --}}
                            <td id="none">
                                {{-- <a href="{{route('employee.edit',$employee->id)}}"><i class="fa fa-lg fa-edit"></i></a> --}}
                                {{-- @method('DELETE')
                                <a onclick="return confirm('Do you want to delete')" href="{{route('employee.destroy', $employee->id)}}"><i class="fa fa-lg fa-minus-circle" style="color:red"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection
@section('scripts')
@include('admin.include.message')
@endsection

