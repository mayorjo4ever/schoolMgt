 <label for="title">City</label>
 <select name="city" onchange="" id="state" class="form-control" required="" >
        <option value="">--</option>
        @foreach($cities as $city)
        <option value="{{$city->id}}" @selected($city->id==$student['city_id']) >{{$city->name}}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
       Select City
    </div>