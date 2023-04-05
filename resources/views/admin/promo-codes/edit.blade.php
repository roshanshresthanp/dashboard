@extends('admin.layouts.app')

@section('title', 'Edit Promo code')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
    <li class="breadcrumb-item text-muted">
		<a href="{{ route('promo-codes.index')}}" class="text-muted">Promo Code</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('promo-codes.edit', $data->id)}}" class="text-active">Edit</a>
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
                    <h3 class="card-title">Edit Promo Code</h3>
                </div>
            </div>
            <!-- form start -->
            <form class="form" action="{{ route('promo-codes.update', $data->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @include('admin.promo-codes.form')

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