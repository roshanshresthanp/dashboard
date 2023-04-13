@extends('admin.layouts.app')

@section('title', 'Cloth type')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('cloth-types.index')}}" class="text-active">Cloth type</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('cloth-types.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('cloth-types.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus" >
	<span style="font-family:Poppins">Add Cloth type</span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Cloth types</h3>
				</div>
			</div>
			<!-- /.card-header -->

            <div class="card-body">
                <table id="example1" class="table table-bordered">
                    <thead>
                    <tr>
                        {{-- <th style='width:15px'>
                            <label class="checkbox checkbox-rounded">
                                <input type="checkbox" checked="checked" name="Checkboxes15_1"/>
                                <span></span>
                            </label>
                        </th> --}}
                        <th>#</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Rate / Piece</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $cloth)
                        <tr>
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>
                           <td>{{$cloth->name}}</td>
                           <td>{{$cloth->parent->name ?? 'Main Category'}}</td>
                           <td>{{$cloth->rate}}</td>
                           <td>
                            @if($cloth->status==1) <span class="badge badge-success">Active </span>
                            @else
                            <span class="badge badge-danger">InActive </span>
                            @endif
                            </td>
                            
                            <td id="none">
                            <form action="{{route('cloth-types.destroy', $cloth->id)}}" method="post">
                                <a href="{{route('cloth-types.edit',$cloth->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
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