<?php 
    use Carbon\Carbon;
    use App\Models\Country; 
    $countries = Country::countries();
    // dd($countries); 
?>
    <div class="form-row mt-0">
       <div class="col-md-4 mb-3">
          <label for="title">Registration No.  </label>
          <input type="text" readonly=""  value="{{$student['regno'] ?? ""}}" name="regno" id="user-regno" class="form-control bg-white" placeholder="Registration No " > 
          <div class="invalid-feedback">
             Provide Your Registration No
          </div>
       </div>
        
        <div class="col-md-4 mb-3">
          <label for="title">Surname  </label>
          <input type="text"   value="{{$student['surname'] ?? ""}}"name="surname" id="user-surname" class="form-control" placeholder="Surname " required > 
          <div class="invalid-feedback">
             Provide Your Surname
          </div>
       </div>
       <!-- col-md-4 -->
       <div class="col-md-4 mb-3">
          <label for="title">First Name </label>
          <input type="text" value="{{$student['firstname'] ?? ""}}"  name="firstname" id="user-firstname" class="form-control" required placeholder="First Name" >
          <div class="invalid-feedback">
             Provide First Name
          </div>
       </div>
       <!-- col-md-4 -->
       <div class="col-md-4 mb-3">
          <label for="title">Other Name </label>
          <input type="text" value="{{$student['othername'] ?? ""}}" name="othername" id="user-othername" class="form-control" placeholder="Other Name" >
          <div class="invalid-feedback">
             Provide Other Name
          </div>
       </div><!-- col-md-4 -->
       
       <div class="col-md-4 mb-3">
          <label for="title">Gender </label>
          <select name="gender" id="user-gender" class="form-control" required="" >
              <option value="">--</option>
              <option value="male" @selected($student['gender']=='male') >Male</option>
              <option value="female"  @selected($student['gender']=='female')>Female</option>
          </select>
          <div class="invalid-feedback">
             Select Gender
          </div>
       </div> <!-- col-md-4 -->
      
       <div class="col-md-4 mb-3">
          <label for="title">Date of birth </label>
          <input type="text" name="dob" id="dob" value="{{ $student['dob'] ?? Carbon::now()->subYears(12)}}" class="form-control datepicker bg-white" required >                        
          <div class="invalid-feedback">
             Provide Date of birth
          </div>
       </div><!-- col-md-4 -->
       
        <div class="col-md-4 mb-3">
          <label for="title">Email </label>
          <input type="email" name="email" id="email" value="{{$student['email'] ?? ""}}" class="form-control bg-white" required >                        
          <div class="invalid-feedback">
             Provide Email Address
          </div>
       </div><!-- col-md-4 -->
        <div class="col-md-4 mb-3">
          <label for="title">Phone Number </label>
          <input type="number" name="mobile" id="mobile" value="{{$student['mobile'] ?? ""}}" class="form-control bg-white" required >                        
          <div class="invalid-feedback">
             Provide Phone Number
          </div>
       </div><!-- col-md-4 -->
       
        <div class="col-md-4 mb-3">
          <label for="title">Home Address </label>
          <input type="text" name="residence" id="residence" value="{{$student['residence'] ?? ""}}" class="form-control bg-white" required >                        
          <div class="invalid-feedback">
             Provide Home Address 
          </div>
       </div><!-- col-md-4 -->
       
        <div class="col-md-4 mb-3">
          <label for="title">Country </label>
          <select name="country" id="country" onchange="load_student_state_of_origin()" class="form-control" required="" >
              <option value="">--</option>
              @foreach($countries as $country)
              <option value="{{$country->id}}" @selected($country->id==$student['country_id'])  @selected($country->id==161) >{{$country->name}}</option>
              @endforeach
          </select>
          <div class="invalid-feedback">
             Select Country
          </div>
       </div> <!-- col-md-4 -->
       
       <div class="col-md-4 mb-3">
           <div class="state_loader"></div>
       </div> <!-- col-md-4 -->
       
       <div class="col-md-4 mb-3">
           <div class="city_loader"></div>
       </div> <!-- col-md-4 -->       
    </div>
    <!-- form-row-->    
    