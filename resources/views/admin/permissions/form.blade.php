@csrf
<div class="card-body">
    <div class="form-group row">
        <label class="col-2 col-form-label">Permission Name</label>
        <div class="col-4">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Permission Name" value="{{old('name',@$data->name)}}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>    
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
<script>
$(document).ready(function(){
    checkallSelected()
    $('#checkall').click(function() {
            if($(this).is(':checked')){
                $('.checkme').prop('checked',true)
            }else{
                $('.checkme').prop('checked',false)

            }
    });

    $('.checkme').click(function() {
            checkallSelected()
    });

    function checkallSelected()
    {
        var checked = $('.checkme:checked');
            var total = $('.checkme');
            
            if (checked.length == total.length) {
                $('.checkall').prop('checked',true)
            } else {
                $('.checkall').prop('checked',false)
            }
    }
});

</script>
