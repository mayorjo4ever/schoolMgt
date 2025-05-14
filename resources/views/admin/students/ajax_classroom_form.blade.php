 <label for="title" class=""> Class Room </label>
       <select name="class_room" class="form-control" required="">
            <option value=""  > ... </option>                                
           @foreach($class_rooms as $room)
            <option value="{{$room['id']}}" @selected($student['class_room_admitted']==$room['id']) >{{ $room['name']}} </option>   
           @endforeach
        </select>
      <div class="invalid-feedback">
         Select Classroom Allocated
      </div>