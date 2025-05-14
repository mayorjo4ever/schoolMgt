<div class="form-row">
        <div class="col-md-3 mb-3">
            <label class="font-weight-600">Role Designation  </label>
           
            <select {{$disable_edit}} multiple="" name="my-roles[]" id="my-roles" class="form-control bg-white" required="" >
                <option value="">...</option>
                @foreach($all_roles as $role)
                <option value="{{$role['name']}}" @selected(in_array($role['name'],$my_roles)) > {{$role['name']}}</option>
               @endforeach
            </select>
            <div class="invalid-feedback">
               Select Role
            </div>
         </div>
         <!-- col-md-3  -->
         <div class="col-md-3 mb-3">
            <label  class="font-weight-600">Major Subjects  </label>
             <select {{$disable_edit}} multiple="" name="my-subjects[]" id="my-subjects" class="form-control bg-white">
                <option value="">...</option>
                @foreach($all_subjects as $subject)
                <option value="{{$subject['id']}}" @selected(in_array($subject['id'],$my_subjects)) > {{$subject['title']}}</option>
               @endforeach
            </select>
            <div class="invalid-feedback">
               Provide Your Surname
            </div>
         </div>
         <!-- col-md-3 -->
         <div class="col-md-3 mb-3">
            <label for="title" class="font-weight-600"> Class Groups </label>
            <select {{$disable_edit}} multiple="" name="my-class-groups[]" id="my-class-groups" class="form-control bg-white">
                <option value="">...</option>
                @foreach($all_classrooms as $classroom)
                <option value="{{$classroom['id']}}" @selected(in_array($classroom['id'],$my_classrooms)) > {{$classroom['name']}}</option>
               @endforeach
            </select>
            <div class="invalid-feedback">
              Select One or More Class Groups
            </div>
         </div>
         <!-- col-md-3 -->
         
         <div class="col-md-3 mb-3"> <!-- for passport -->
              <div class="img-fluid">
                <div class="img-thumbnail border-gray-400"><center>
                    @if(Session::get('current_staff_psp'))
                    <img src="{{asset('images/staff/temp/'.Session::get('current_staff_psp'))}}" class="staff-passport img rounded-circle" height="200" width="180" />

                    @elseif($admin['pix'] !="")
                     <img src="{{asset('images/staff/passports/'.$admin['pix'])}}" class="staff-passport img rounded-circle" height="200" width="180" />

                    @else
                    <img src="{{asset('images/user.png')}}" class="staff-passport img rounded-circle" height="200" width="180" />
                    @endif
                    </center>
                </div><!-- img thumbnail  -->
             </div>  
             <button type="button" onclick="$('#file').click()" class="btn btn-info w-100 btn-sm font-weight-700"> Change Passport </button>
             <input onchange="uploadStaffPsp()" type="file" name="file" id="file" class="form-control form-control-file" style="visibility:hidden; display:none; " />
         </div>
         
         
      </div>
      <!-- ./ form-row --> 