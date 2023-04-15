@extends('admin.layouts.app')

@section('title', 'Pickup Time')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('pickup-times.index')}}" class="text-active">Pickup Time</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('pickup-times.index')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

@section('actionButton')
<a href="{{ route('pickup-times.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus">
	<span style="font-family:Poppins">Add Pickup Time</span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Pickup Times</h3>
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
                        <th>Pickup Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $time)
                        <tr>
                        {{-- <td><label class="checkbox checkbox-rounded">
                                <input type="checkbox"  name="Checkboxes15_1"/>
                                <span></span>
                            </label></td> --}}
                            <td style="width:15px">
                                {{$loop->iteration}}
                            </td>
                           <td>{{$time->time}}</td>
                           <td>
                            @if($time->status==1) <span class="badge badge-success">Active </span>
                            @else
                            <span class="badge badge-danger">InActive </span>
                            @endif
                            </td>
                            <td id="none">
                            <form action="{{route('pickup-times.destroy', $time->id)}}" method="post">
                                <a href="{{route('pickup-times.edit',$time->id)}}"><i class="btn btn-light fa fa-edit "></i></a>
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