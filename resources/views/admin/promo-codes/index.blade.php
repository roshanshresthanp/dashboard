@extends('admin.layouts.app')

@section('title', 'Promo code')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('promo-codes.index')}}" class="text-active">Promo code</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('promo-codes.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('promo-codes.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus" >
	<span style="font-family:Poppins">Add Promo code</span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Promo Codes</h3>
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
                        <th>Title</th>
                        <th>Code</th>
                        <th>Discount type</th>
                        <th>Worth</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Usage Limit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $promo)
                        <tr>
                        {{-- <td><label class="checkbox checkbox-rounded">
                                <input type="checkbox"  name="Checkboxes15_1"/>
                                <span></span>
                            </label></td> --}}
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>
                           <td>{{$promo->title}}</td>
                           <td>{{$promo->code}}</td>
                           {{-- <td>{{$promo->status}}</td> --}}
                           <td>{{$promo->promo_type}}</td>
                           <td>{{$promo->worth}}</td>
                           <td>{{$promo->activation_date}}</td>
                           <td>{{$promo->expire_date}}</td>
                           <td>{{$promo->usage_limit}}</td>




                           <td>
                            @if($promo->status==1) <span class="badge badge-success">Active </span>
                            @else
                            <span class="badge badge-danger">InActive </span>
                            @endif
                            </td>
                            
                            <td id="none">
                            <form action="{{route('promo-codes.destroy', $promo->id)}}" method="post">
                                <a href="{{route('promo-codes.edit',$promo->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
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