@extends('admin.layouts.app')

@section('title', 'Users')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('users.index')}}" class="text-active">Users</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('users.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('users.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus" >
	<span style="font-family:Poppins">Add Users</span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Users</h3>
				</div>
			</div>
			<!-- /.card-header -->

            <div class="card-body">
                <table id="example1" class="table table-bordered text-center">
                    <thead>
                    <tr>
                        {{-- <th style='width:15px'>
                            <label class="checkbox checkbox-rounded">
                                <input type="checkbox" checked="checked" name="Checkboxes15_1"/>
                                <span></span>
                            </label>
                        </th> --}}
                        <th>#</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>


                    </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($users->first()) --}}
                    @foreach($users as $user)
                        <tr>
                        {{-- <td><label class="checkbox checkbox-rounded">
                                <input type="checkbox"  name="Checkboxes15_1"/>
                                <span></span>
                            </label></td> --}}
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>


                        <td><img src={{$user->image}} style="height:45px;width:45px;" ></td>
                        <td>{{$user->name}}</td>
                        <td>@foreach ($user->roles as $role)
                            {{$role->name}} <br>
                            @endforeach
                        </td>

                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>
                            @if($user->status==1) <span class="badge badge-success">Active </span>
                            @else
                            <span class="badge badge-danger">InActive </span>
                            @endif
                            </td>
                        <td>{{$user->created_at}}</td> 



                        
                           {{-- <td>
                            @if($users->status==1) <span class="badge badge-success">Active </span>
                            @else
                            <span class="badge badge-danger">InActive </span>
                            @endif
                            </td> --}}
                            
                            <td id="none">
                            <form action="{{route('users.destroy', $user->id)}}" method="post">
                                <a href="{{route('users.edit',$user->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-sm btn-light ml-2 ">
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
<script src="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": false,

            // "scrollX": true,
            // "aaSorting": []
        });

        // $('#example1').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
    });
</script>
<script src="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
@include('admin.include.message')
@endsection