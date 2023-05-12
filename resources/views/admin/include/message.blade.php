{{-- <script src="{{asset('admin/assets/js/pages/features/miscellaneous/toastr.js')}}"></script> --}}
<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
@if(Session::has('message'))
toastr.success("{{ session('message') }}");
@endif

@if(Session::has('success'))
toastr.success("{{ session('success') }}");
@endif

@if(Session::has('error'))  
toastr.error("{{ session('error') }}");
@endif

@if($errors)
@foreach($errors->all() as $err)
toastr.options =
{
    "progressBar" : false
}
toastr.info("{{$err}}");
@endforeach
@endif
</script>