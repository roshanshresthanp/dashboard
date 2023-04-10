@extends('admin.layouts.app')

@section('title', 'Enquiries')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('enquiries.index')}}" class="text-active">Enquiries</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('enquiries.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('enquiries.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus" >
	<span style="font-family:Poppins">Add Enquiry</span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Enquiries</h3>
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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $enquiry)
                        <tr>
                        {{-- <td><label class="checkbox checkbox-rounded">
                                <input type="checkbox"  name="Checkboxes15_1"/>
                                <span></span>
                            </label></td> --}}
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>
                           <td>{{$enquiry->name}}</td>
                           <td>{{$enquiry->email}}</td>
                           {{-- <td>{{$enquiry->status}}</td> --}}
                           <td>{{$enquiry->phone}}</td>
                           <td>{{$enquiry->message}}</td>
                           <td>{{$enquiry->source}}</td>
                           {{-- <td>{{$enquiry->expire_date}}</td> --}}
                           {{-- <td>{{$enquiry->usage_limit}}</td> --}}
                           <td>
                            @if($enquiry->status==1)
                            <span class="badge badge-info">Pending </span>
                            @elseif(($enquiry->status==2))
                            <span class="badge badge-success">Solved</span>
                            @elseif(($enquiry->status==0))
                            <span class="badge badge-warning">Unread</span>
                            @endif
                            </td>
                            <td id="none">
                            {{-- <form action="{{route('enquiries.status',[$enquiry->id,1] )}}" method="post">
                                <a href="{{route('enquiries.edit',$enquiry->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-sm btn-light ml-2 ">
                                <i class="fa fa-minus-circle" style="color:red"></i>
                                </button>
                            </form> --}}

                            @if($enquiry->status==0) 
                            <a href="{{route('enquiries.status',[$enquiry->id,1] )}}" title="Mark as read"><i class="btn btn-sm btn-info fa fa-eye "></i></a>
                            @elseif(($enquiry->status==1))
                            <a href="{{route('enquiries.status',[$enquiry->id,2] )}}" title="Mark as solved"><i class="btn btn-sm btn-success fa fa-check-circle "></i></a>
                            @endif
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