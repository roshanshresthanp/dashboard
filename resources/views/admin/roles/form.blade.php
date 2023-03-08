@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-2 col-form-label">Role Name</label>
        <div class="col-4">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Role Name" value="{{old('name',@$data->name)}}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>
</div>
