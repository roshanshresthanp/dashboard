@csrf
<div class="card-body row">
    <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Name</label>
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
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{old('email',@$data->email)}}" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-6 row">
        <label class="col-form-label col-lg-4 col-sm-12">Source Type</label>
        <div class=" col-lg-8 col-md-9 col-sm-12">
         <select class="form-control  @error('source') is-invalid @enderror" id="" name="source">
            <option value="email">Email</option>
            <option value="call">Call</option>
            <option value="call">Others</option>
         </select>
         @error('source')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
         @enderror
        </div>
    </div>
    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Phone</label>
        <div class="col-8">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="" value="{{old('phone',@$data->phone)}}" />
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-sm-6 row">
        <label class="col-4 col-form-label">Message</label>
        <div class="col-8">
            <textarea required class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Enter message" > {{old('message')}}
            </textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>
    
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
       </div>
    <div class="form-group col-sm-6 row">
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
        <label class="col-4 col-form-label">Sloved</label>
        <div class="col-8">
            <span class="switch switch-success">
                <label>
                    <input type="checkbox"  
                    @checked(old('status'))
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
{{-- <script src="{{asset('admin/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script> --}}
{{-- <script src="{{asset('admin/assets/js/pages/crud/forms/widgets/select2.js')}}"></script> --}}
