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
                    <h3 class="card-title">List of Roles</h3>
				</div>
			</div>
			<!-- /.card-header -->

            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                    <tr>
                        {{-- <th style='width:15px'>
                            <label class="checkbox checkbox-rounded">
                                <input type="checkbox" checked="checked" name="Checkboxes15_1"/>
                                <span></span>
                            </label>
                        </th> --}}
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $role)
                        <tr>
                        {{-- <td><label class="checkbox checkbox-rounded">
                                <input type="checkbox"  name="Checkboxes15_1"/>
                                <span></span>
                            </label></td> --}}
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>
                           <td>{{$role->name}}</td>
                            <td id="none">
                            <form action="{{route('roles.destroy', $role->id)}}" method="post">
                                <a href="{{route('roles.edit',$role->id)}}"><i class="btn btn-light fa fa-edit "></i></a>
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-light ml-2 ">
                                <i class="fa fa-minus-circle" style="color:red"></i>
                                </button>
                            </form>
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