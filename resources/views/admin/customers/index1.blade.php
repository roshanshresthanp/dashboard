@extends('admin.layouts.app')

@section('title', 'Customer')
@section('styles')
<link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
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
	Add Customer
</a>
@endsection --}}

@section('content')
 <!--begin::Card-->
 <div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                Customers
            {{-- <span class="d-block text-muted pt-2 font-size-sm">Sorting &amp; pagination remote datasource</span></h3> --}}
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md fa fa-file-export">
                </span>Export</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md fa fa-plus">
               
            </span>Add Record</a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        <!--begin: Search Form-->
        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="row align-items-center">
                        {{-- <div class="col-md-4 my-2 my-md-0">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div> --}}
                        <div class="col-md-3 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                <select class="form-control" id="status">
                                    <option value="" hidden>All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    {{-- <option value="3">Canceled</option>
                                    <option value="4">Success</option>
                                    <option value="5">Info</option>
                                    <option value="6">Danger</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                <select class="form-control" id="kt_datatable_search_type">
                                    <option hidden>All</option>
                                    <option value="1">Online</option>
                                    <option value="2">Retail</option>
                                    <option value="3">Direct</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Date:</label>
                                    <div class='input-group ' id='kt_daterangepicker_2'>
                                        <input type='text' id="datepicker" class="form-control" readonly  placeholder="Select date range"/>
                                        <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                        </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                    <button class="btn btn-light-primary px-6 font-weight-bold" id="clear">Clear</button>
                </div>
            </div>
        </div>
        <!--end::Search Form-->
        <!--end: Search Form-->
        <!--begin: Datatable-->
        
        {{-- <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div> --}}
        <table id="tableData" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Bucket</th>
                <th>Order</th>
                <th>Amt Spent</th>
                <th>Status</th>
                {{-- <th>Rating</th> --}}
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@endsection

@section('scripts')
<script src="{{asset('admin/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    let a = 5;
    let table = $('#tableData').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
        "scrollX": true,
        "pageLength": "50",
        "order": [[0, 'desc']],
        "ajax": {
            "url": '{{ route('customers.index')}}',
            "data": function (d) {
                // d.booking = {{ isset($booking) ? $booking : -1 }},
                d.status = $('#status').val(),
                d.date = $('#kt_daterangepicker_2 .form-control').val()
            }
        },
        
        columnDefs: [{
            targets: -1,
            className: 'text-right'
        }],
        "colVis": {
            exclude: [1,2]
        },
        "columns": [
            {"data": "id", 'visible': true,orderable: false, searchable: false},
            {"data": "image", orderable: false, searchable: false},
            {"data": "name"},
            {"data": "email"},
            {"data": "mobile"},
            {"data": "bucket", searchable: false, orderable: false},
            {"data": "order", searchable: false, orderable: false},
            {"data": "spent", searchable: false},

            {"data": "status", searchable: false},
            // {"data": "blacklisted_html", searchable: false},
            {"data": "created_at"},
            {"data": "actions", orderable: false, searchable: false},
        ],
    });

    $('#clear').on('click', () => {
	    jQuery('#status').val(null).trigger('change');
        jQuery('#datepicker').val(null).trigger('change');

    });

    $("#status").on('change', function(){
		table.draw();
	});

    // $("#datepicker").on('input', function(){
    //     alert('date');
	// 	table.draw();
	// });

    $(document).ready(function() {
        $('#kt_daterangepicker_2').daterangepicker({
   buttonClasses: ' btn',
   applyClass: 'btn-primary',
   cancelClass: 'btn-secondary'
  }, function(start, end, label) {
    // alert(start);
   $('#kt_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
   table.draw();

  });
});

</script>

@include('admin.include.message')
@endsection