@extends('admin.layouts.app')

@section('title', 'Add Setting')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	<li class="breadcrumb-item text-muted">
		<a href="{{route('dashboard') }}" class="text-muted">Dashboard</a>
	</li>
    <li class="breadcrumb-item text-muted">
		<a href="{{ route('settings.index')}}" class="text-muted">Company Setting</a>
	</li>
	<li class="breadcrumb-item text-active">
		<a href="{{ route('settings.create')}}" class="text-active">Add</a>
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
                    <h3 class="card-title">Add Setting</h3>
                </div>
            </div>
            <!-- form start -->
            <form class="form" action="{{ route('settings.store') }}" enctype="multipart/form-data" method="post">	
                @csrf
                <div class="card-body">
                {{-- @include('admin.settings.form') --}}
                <div id="formContainer">
                    <div class="form-group col-8 row">
                        <div class="col-5">
                            <input type="text" required class="form-control" name="key[]" placeholder="Enter key title"  />
                        </div>  
                        <div class="col-5">
                            <input type="text" class="form-control" name="value[]" placeholder="Enter value"  />
                        </div> 
                        <button type="button" id="addButton" class="btn btn-sm btn-light-info font-weight-bold btn btn-primary">Add</button>

                    </div>

                </div>


                </div>

                <div class="card-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
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
<script>
let formCount = 1;
const formContainer = document.getElementById("formContainer");
const addButton = document.getElementById("addButton");

addButton.addEventListener("click", () => {
    const newForm = document.createElement("div");
    newForm.classList.add("form-group");
    newForm.innerHTML = `
                    <div class="form-group col-8 row">
                        <div class="col-5">
                            <input type="text" class="form-control" required name="key[]" placeholder="Enter key title"  />
                        </div>  
                        <div class="col-5">
                            <input type="text" class="form-control" name="value[]" placeholder="Enter value"  />
                        </div> 
                        <button type="button" class="btn btn-sm btn-light-danger font-weight-bold removeButton">Remove</button>
                    </div>
    `;
    formContainer.appendChild(newForm);
    formCount++;
});

formContainer.addEventListener("click", (event) => {
    if (event.target.classList.contains("removeButton")) {
        event.target.parentNode.remove();
    }
});
</script>
@include('admin.include.message')
@endsection


