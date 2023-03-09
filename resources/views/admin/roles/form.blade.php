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

    <div class="form-group row">
        <label class="col-2 col-form-label">Permissions</label>
            <div class="col-10">
            <div class="checkbox-inline">
            {{-- @dd($data->permissions()->pluck('id')->toArray()) --}}
                @foreach ($permissions as $permission)
                    <div class="col-3">
                        <label class="checkbox checkbox-rounded">
                            <input type="checkbox" @if(in_array($permission->id,$data->permissions()->pluck('id')->toArray())) checked @endif name="permissions[]"/>
                            <span></span>
                            {{$permission->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
            
    </div>
</div>

<div class="card-body">
    
</div>
