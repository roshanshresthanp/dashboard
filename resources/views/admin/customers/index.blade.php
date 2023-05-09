@extends('admin.layouts.app')

@section('title', 'Customer')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('customers.index')}}" class="text-active">Customers</a>
	</li>
    {{-- <li class="breadcrumb-item text-active">
		<a href="{{ route('roles.index')}}" class="text-active">List</a>
	</li> --}}
</ul>
@endsection

{{-- @section('actionButton')
<a href="{{ route('roles.create') }}" class="btn btn-primary font-weight-bolder fas fa-plus">
<span style="font-family:Poppins">	Add Customer </span>
</a>
@endsection --}}

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container" id="app">
        <!--begin::Card-->
        <user-component>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


@endsection

@section('scripts')
{{-- <script src="{{asset('admin/assets/js/pages/crud/ktdatatable/base/data-ajax.js')}}"></script> --}}
@vite('resources/js/user.js')

<script>
// import exampleComponent from '/components/ExampleComponent.vue'
</script>
@include('admin.include.message')
@endsection