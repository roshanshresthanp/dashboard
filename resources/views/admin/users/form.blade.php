@csrf
<div class="card-body row">
    <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Full Name</label>
        <div class="col-8">
            <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{old('name',@$data->name)}}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Email</label>
        <div class="col-8">
            <input type="email" required class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{old('email',@$data->email)}}" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>
    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Username</label>
        <div class="col-8">
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Enter username" value="{{old('username',@$data->username)}}" />
            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Mobile</label>
        <div class="col-8">
            <input type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Enter mobile" value="{{old('mobile',@$data->mobile)}}" />
            @error('mobile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>
    <div class="form-group col-6 row">
        <label class="col-form-label col-lg-4 col-sm-12">Role</label>
        <div class=" col-lg-8 col-md-9 col-sm-12">
         <select class="form-control  @error('roles') is-invalid @enderror" id="" name="role_id">
            @foreach ($roles as $role)
                <option value="{{$role->id}}" @selected(in_array($role->id,@$data->roles?->pluck('id')->toArray() ?? []) || old('role_id') ) > {{$role->name}} <dd></dd></option>
            @endforeach
            {{-- @selected($cat->id == @$data->parent_id) --}}
         </select>
         @error('promo_type')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
         @enderror
        </div>
    </div>
    {{-- <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Worth</label>
        <div class="col-8">
            <input type="text" required class="form-control @error('worth') is-invalid @enderror" name="worth" placeholder="" value="{{old('worth',@$data->worth)}}" />
            @error('worth')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div> --}}
    {{-- <div class="form-group col-6 row">
        <label class="col-form-label col-lg-4 col-sm-12">Date & Time range</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
         <div class='input-group' id='kt_daterangepicker_4'>
          <input type='text' required name="range" value="{{old('range',@$data->activation_date.' / '.@$data->expire_date)}}" class="form-control @if($errors->first('activation_date') || $errors->first('expire_date')) is-invalid @endif" 
          readonly placeholder="Select date & time range"/>
          <div class="input-group-append">
           <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
          </div>
          @if($errors->first('activation_date') || $errors->first('expire_date'))
                <span class="invalid-feedback" role="alert">
                    <strong>
                        <li>{{ $errors->first('activation_date')}}</li>
                        <li> {{ $errors->first('expire_date')}} </li>
                        </strong>
                </span>
          @endif
         </div>
        </div>
       </div> --}}
    {{-- <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Usage limit</label>
        <div class="col-8">
            <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" name="usage_limit" placeholder="Enter Usage limit" value="{{old('usage_limit',@$data->usage_limit)}}" />
            @error('usage_limit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div> --}}

    <div class="form-group col-6 row">
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
    </div>
    
    {{-- <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Featured Status</label>
        <div class="col-8">
            <span class="switch switch-primary">
                <label>
                    <input type="checkbox"  
                    @checked(@$data->featured_status ==1 || old('featured_status'))
                    name="featured_status" />
                    <span></span>
                </label>
            </span>
        </div>
    </div> --}}
</div>
<script src="{{asset('admin/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>
{{-- <script src="{{asset('admin/assets/js/pages/crud/forms/widgets/select2.js')}}"></script> --}}
