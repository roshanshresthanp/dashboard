@extends('admin.layouts.app')
@section('title', 'SMS')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('smsLog')}}" class="text-active">SMS</a>
	</li>
    <li class="breadcrumb-item text-active">
		<a href="{{ route('smsLog')}}" class="text-active">List</a>
	</li>
</ul>
@endsection

{{-- @section('actionButton')
<a href="{{ route('SMS.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus" >
	<span style="font-family:Poppins">Add sms</span>
</a>
@endsection --}}

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">SMS Logs</h3>
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
                        <th>Sent Date</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Provider</th>
                        <th>Status</th>

                        {{-- <th>Message</th>
                        <th>Source</th>
                        <th>Actions</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $sms)
                        <tr>
                            <td style="width:15px">
                                {{$loop->updated_at}}
                            </td>
                           <td>{{$sms->number}}</td>
                           <td>{{$sms->message}}</td>
                           <td>{{$sms->provider}}</td>
                           <td>
                            @if($sms->status==0)
                            <span class="badge badge-danger">Failed </span>
                            @elseif(($sms->status==1))
                            <span class="badge badge-success">Sent</span>
                            @endif
                            </td>
                           {{-- <td>{{$sms->message}}</td>
                           <td>{{$sms->source}}</td> --}}
                           {{-- <td>{{$sms->expire_date}}</td> --}}
                           {{-- <td>{{$sms->usage_limit}}</td> --}}
                           
                            <td id="none">
                            {{-- <form action="{{route('SMS.status',[$sms->id,1] )}}" method="post">
                                <a href="{{route('SMS.edit',$sms->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-sm btn-light ml-2 ">
                                <i class="fa fa-minus-circle" style="color:red"></i>
                                </button>
                            </form> --}}

                            @if(($sms->status==1))
                            <a href="{{route('sms.resend',$sms->id )}}" title="Resend"><i class="btn btn-sm btn-success fa fa-check-circle "></i></a>
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