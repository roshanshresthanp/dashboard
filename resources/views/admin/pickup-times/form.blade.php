@csrf
<div class="card-body row">
    <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Pick Up Time</label>
        <div class="col-8">
            <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" placeholder="Enter Pickup time" value="{{old('time',@$data->time)}}" />
            @error('time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>
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
</div>
