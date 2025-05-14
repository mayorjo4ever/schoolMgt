<div class="form-row">
        <div class="col-md-3 mb-3">
            <label for="title" class="font-weight-600">Title  </label>
            @php $titles = ['Mr.','Mrs.','Miss','Dr.','Dr.(Mrs.)','Prof.']; @endphp 
            <select {{$disable_edit}} name="title" id="user-title" class="form-control bg-white" >
                <option value="">...</option>
                @foreach($titles as $title)
               <option value="{{$title}}" @if($admin['title']==$title))  selected="" @endif >{{$title}}</option>
               @endforeach
            </select>
            <div class="invalid-feedback">
               Provide Your Title
            </div>
         </div>
         <!-- col-md-3  -->
         <div class="col-md-3 mb-3">
            <label for="title" class="font-weight-600">Surname  </label>
            <input {{$disable_edit}}  type="text" @if(!empty($admin['surname'])) value="{{$admin['surname']}}" @endif  name="surname" id="user-surname" class="form-control bg-white" required > 
            <div class="invalid-feedback">
               Provide Your Surname
            </div>
         </div>
         <!-- col-md-3 -->
         <div class="col-md-3 mb-3">
            <label for="title" class="font-weight-600">First Name </label>
            <input {{$disable_edit}} type="text" @if(!empty($admin['firstname'])) value="{{$admin['firstname']}}" @endif  name="firstname" id="user-firstname" class="form-control bg-white" required >                        
            <div class="invalid-feedback">
               Provide First Name
            </div>
         </div>
         <!-- col-md-3 -->
         <div class="col-md-3 mb-3">
            <label for="title" class="font-weight-600">Other Name </label>
            <input {{$disable_edit}}  type="text" @if(!empty($admin['othername'])) value="{{$admin['othername']}}" @endif  name="othername" id="user-othername" class="form-control bg-white" >                        
            <div class="invalid-feedback">
               Provide Other Name
            </div>
         </div>
         <!-- col-md-3 -->
      </div>
      <!-- ./ form-row --> 
      
      <div class="form-row">                  
        <div class="col-md-3 mb-3">
           <label for="title" class="font-weight-600">Email </label>
           <input {{$disable_edit}}  type="email"  @if(!empty($admin['email'])) value="{{$admin['email']}}" @endif name="email" id="user-email" class="form-control bg-white" required="" >                        
           <div class="invalid-feedback">
              Provide Email
           </div>
        </div> <!-- col-md-3 -->
         <div class="col-md-3 mb-3">
           <label for="title" class="font-weight-600">Mobile Phone </label>
           <input {{$disable_edit}}  type="number"  @if(!empty($admin['mobile'])) value="{{$admin['mobile']}}" @endif name="mobile" id="user-mobile" class="form-control bg-white" required="" >                        
           <div class="invalid-feedback">
              Provide Mobile Phone 
           </div>
        </div> <!-- col-md-3 -->

        <div class="col-md-3 mb-3">
           <label for="title" class="font-weight-600">Alternative Login ID </label>
           <input {{$disable_edit}}  type="text"  @if(!empty($admin['regno'])) value="{{$admin['regno']}}" @endif name="regno" id="user-regno" class="form-control bg-white" >                        
           <div class="invalid-feedback">
              Provide Alternative Login ID 
           </div>
        </div> <!-- col-md-3 -->

        <div class="col-md-3 mb-3">
            <div>
              <div class="custom-checkbox custom-control custom-control-inline  mb-1">
                  <input name="reset_password" value="yes" type="checkbox" id="reset_password" class="custom-control-input">
                      <label class="custom-control-label" for="reset_password">Reset Password To New </label>
              </div>
             </div>
            <input {{$disable_edit}}  type="text" name="password" id="user-password" class="form-control mt-1 bg-white" placeholder="New Password" >
        </div>
     </div>
     <!-- form-row-->