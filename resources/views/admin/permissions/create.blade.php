@extends('admin.layouts.app')

@section('title', 'Add Permission')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
    <li class="breadcrumb-item text-muted">
		<a href="{{ route('permissions.index')}}" class="text-muted">Permission</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('permissions.create')}}" class="text-active">Add</a>
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
                    <h3 class="card-title">Add Permission</h3>
                </div>
            </div>
            <!-- form start -->
            <form class="form"  action="{{ route('permissions.store') }}" enctype="multipart/form-data" method="post">	
                
                @include('admin.permissions.form')

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

