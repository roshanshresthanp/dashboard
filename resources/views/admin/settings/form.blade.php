@csrf
<div class="card-body">
    @foreach ($settings as $set)
    <div class="form-group col-8 row">
        <label class="col-4 col-form-label">{{$set->key}}</label>
        <div class="col-5">
            <input type="text" class="form-control @error('{{$set->id}}') is-invalid @enderror" name="{{$set->id}}" placeholder="Enter name" value="{{$set->value}}" />
            @error('{{$set->id}}')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
         <div class="col-2">
            {{-- <form action="{{route('settings.destroy', $set->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-sm btn-light-danger font-weight-bold ">
                <i class="fa fa-minus-circle mr-2"></i>Delete
                </button>
            </form> --}}

            {{-- <a  href="{{route('settings.destroy',$set->id)}}" href="Delete" class="btn btn-sm btn-light-danger font-weight-bold">Delete</a> --}}
        </div> 


    </div>
    @endforeach
</div>