@extends('admin.layouts.app')

@section('title', 'Edit Time')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
    <li class="breadcrumb-item text-muted">
		<a href="{{ route('pickup-times.index')}}" class="text-muted">Time</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('pickup-times.edit', $data->id)}}" class="text-active">Edit</a>
	</li>
</ul>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">Edit Time</h3>
                </div>
            </div>
            <!-- form start -->
            <form class="form" action="{{ route('pickup-times.update', $data->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @include('admin.pickup-times.form')

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- form end -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
 @endsection
@section('scripts')
@include('admin.include.message')
@endsection