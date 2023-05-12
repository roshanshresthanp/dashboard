@extends('admin.layouts.app')

@section('title', 'Edit Setting')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
    <li class="breadcrumb-item text-muted">
		<a href="{{ route('settings.index')}}" class="text-muted">Setting</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="#" class="text-active">Edit</a>
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
                    <h3 class="card-title">Company Setting</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{ route('settings.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md fa fa-plus">
                       
                    </span>Add Record</a>
                    <!--end::Button-->
                </div>
            </div>
            <!-- form start -->
            <form class="form" action="{{ route('settings.update', 1) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @include('admin.settings.form')

                <div class="card-footer">
                    <button type="reset" class="btn btn-danger">Clear</button>
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