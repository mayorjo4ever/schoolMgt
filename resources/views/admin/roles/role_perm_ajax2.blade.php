
<div class="form-row">  
   @foreach($perms as $perm)

    <div class="col-md-3 mt-2 mb-2 w-75  table table-bordered @if(in_array($perm['id'],$assigned_perms)) table-success @endif ">
        <div class="mt-2 mb-2">
            <div class="custom-checkbox custom-control custom-control-inline">
                <input type="checkbox" value="{{$perm['id']}}" data-role="{{$role_id}}" id="custom_{{$perm['id']}}" class="role-perm-custom custom-control-input" @if(in_array($perm['id'],$assigned_perms)) checked="" @endif>
                &nbsp; &nbsp; 
                <label class="custom-control-label" for="custom_{{$perm['id']}}">
                 {{$perm['name']}}  </label>
            </div>    
        </div>
     </div>
      @endforeach
</div>

 
                                                    