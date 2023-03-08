@extends('admin.layouts.app')
@section('content')

@endsection


@section('title', 'Customer')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ url()->current()}}" class="text-active">Customer</a>
	</li>
</ul>
@endsection
@section('page-specific-css')
<link href="{{asset('plugins/lightbox/lightbox.css')}}" rel="stylesheet" type="text/css" />
<style>
    table tr.danger{
        background-color: #f9b9b9 !important;
    }
</style>
@endsection
@section('actionButton')
<a href="#" class="btn btn-primary font-weight-bolder fas fa-plus">
	Add Customer
</a>
@endsection

@section('content')
<div class="row" id="app">
    <user-component>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
@section('script')
{{-- <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/lightbox/lightbox.js')}}"></script> --}}

{{-- <script>
    $('#tableData').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
        "scrollX": true,
        "pageLength": "50",
        "order": [[0, 'desc']],
        "ajax": '{{ route('customer.data', ['type' => $type])}}',
        columnDefs: [{
            targets: -1,
            className: 'text-right'
        }],
        "colVis": {
            exclude: [1,2]
        },
        "columns": [
            {"data": "id", 'visible': true},
            {"data": "image", orderable: false, searchable: false},
            {"data": "first_name"},
            {"data": "last_name"},
            @if ($type == 2)
            {"data": "company"},
            @endif
            {"data": "phone"},
            {"data": "total_bookings", searchable: false},
            {"data": "blacklisted_html", searchable: false},
            // {"data": "status_badge"},
            {"data": "actions", orderable: false, searchable: false},
        ],
        "createdRow": function (row, data) {
            if (data['blacklisted'] == 1) {
                $(row).addClass('table-danger');
            }
        }
    });
</script> --}}
{{-- <script>
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script> --}}
@endsection