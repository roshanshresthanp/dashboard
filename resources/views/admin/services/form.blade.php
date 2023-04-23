@csrf
<div class="card-body row">
    <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Name</label>
        <div class="col-8">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter service" value="{{old('name',@$data->name)}}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
    </div>

    <div class="form-group col-sm-6 row">
        
        <span class="col-4  input-group-btn">
            <a id="" data-input="thumbnail" data-preview="holder" class="btn btn-primary imgpop">
              <i class="fa fa-picture-o"></i> Select Image
            </a>
        </span>
        <div class="col-8">
            <input id="thumbnail" data-preview="holder" type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old('image',@$data->image)}}" readonly/>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <img id="holder" style="margin-top:15px;max-height:100px;">
   
    </div>
    <div class="form-group col-6 row">
        <label class="col-4 col-form-label">Status</label>
        <div class="col-8">
            <span class="switch switch-success">
                <label>
                    <input type="checkbox"  
                    @checked(@$data->status ==1 || old('status'))
                    name="status" />
                    <span></span>
                </label>
            </span>
        </div>
    </div>
</div>
