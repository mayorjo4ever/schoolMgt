 <div id="">
    @foreach($all_roles as $role)
       <div class="custom-checkbox custom-control mb-3">
           <input type="checkbox" value="{{$role['name']}}" name="your_roles[]" id="role_{{$role['id']}}" @if(in_array($role['name'],$my_roles)) checked="" @endif class="custom-control-input role-list">
           <label class="custom-control-label" for="role_{{$role['id']}}"> 
        {{$role['name']}}</label></div>
   @endforeach 

</div>