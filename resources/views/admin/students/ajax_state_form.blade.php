 <label for="title">State of Origin </label>
 <select name="state" onchange="load_student_cities()" id="state" class="form-control" required="" >
        <option value="">--</option>
        @foreach($states as $state)
        <option value="{{$state->id}}" @selected($state->id==$student['state_id']) >{{$state->name}}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
       Select State of Origin
    </div>