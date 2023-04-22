@csrf
<div class="card-body row">
    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Cloth Type</label>
        <div class="col-8">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name" value="{{old('name',@$data->name)}}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    {{-- <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Category</label>
        <div class="col-8">
            <input type="text" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" placeholder="Enter Permission Name" value="{{old('name',@$data->parent_id)}}" />
            @error('parent_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div> --}}

    <div class="form-group col-6 row">
        <label class="col-form-label col-lg-4 col-sm-12">Category</label>
        <div class=" col-lg-8 col-md-9 col-sm-12">
         <select class="form-control select2 @error('parent_id') is-invalid @enderror" id="kt_select2_1" name="parent_id">
          <option value="0">Main Category</option>
            @foreach ($category as $cat)
            <option value="{{$cat->id}}" @selected($cat->id == @$data->parent_id) >{{$cat->name}}</option>
            @endforeach

         </select>
         @error('parent_id')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
         @enderror
        </div>
    </div>

    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Rate</label>
        <div class="col-8">
            <input type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" placeholder="Enter rate" value="{{old('rate',@$data->rate)}}" />
            @error('rate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-sm-6 row">
        
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
        </span>

        <div class="col-8">
            <input id="thumbnail" class="form-control" type="text" name="filepath">

            <input type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" placeholder="Enter rate" value="{{old('rate',@$data->rate)}}" />
            {{-- @error('rate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
        </div> 
        <img id="holder" style="margin-top:15px;max-height:100px;">
   
    </div>


    {{-- <div class="input-group">
        <span class="input-group-btn">
          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
          </a>
        </span>
        <input id="thumbnail" class="form-control" type="text" name="filepath">
    </div>
      <img id="holder" style="margin-top:15px;max-height:100px;"> --}}



    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Status</label>
        <div class="col-8">
            <span class="switch switch-success">
                <label>
                    <input type="checkbox"  
                    @checked(@$data->status ==1 || old('status'))
                    {{-- @if(isset($data->status) && $data->status !=1) @else checked="checked" @endif  --}}
                    name="status" />
                    <span></span>
                </label>
            </span>
        </div>
        {{-- <label class="col-3 col-form-label">Primary</label>
        <div class="col-3">
            <span class="switch switch-primary">
                <label>
                    <input type="checkbox" checked="checked" name="select" />
                    <span></span>
                </label>
            </span>
        </div> --}}
    </div>

    {{-- <div class="form-group row">
        <label class="col-2 col-form-label">Permissions</label>
            <div class="col-10">
                <div class="checkbox-inline">
                    <div class="col-12 ">
                        <label class="checkbox checkbox-rounded">
                            <input type="checkbox"  id="checkall" class="checkall" />
                            <span></span>
                            <b>Check all permission</b>
                        </label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="col-3">
                            <label class="checkbox checkbox-rounded">
                                <input type="checkbox" class="checkme" @if(isset($data) && in_array($permission->id,$data?->permissions()->pluck('id')->toArray())) checked  @endif value="{{$permission->id}}" name="permissions[]"/>
                                <span></span>
                                {{$permission->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
        </div>
            
    </div> --}}
</div>
<script src="{{asset('admin/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>

