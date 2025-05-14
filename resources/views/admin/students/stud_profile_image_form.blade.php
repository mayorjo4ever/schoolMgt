
 <h6 class="font-weight-bold mt-4 text-uppercase"> Profile Image </h6>
 <hr class="mb-0 mt-0"/>
 
 <div class="form-row mt-4"> 
     <div class="col-md-4 offset-md-4 ">
         <div class="img-fluid">
             <div class="img-thumbnail border-gray-400"><center>
                 @if(Session::get('current_temp_psp'))
                 <img src="{{asset('images/students/temp/'.Session::get('current_temp_psp'))}}" class="student-passport img rounded-circle" height="200" width="180" />
                 
                 @elseif($student['pix'] !="")
                  <img src="{{asset('images/students/passports/'.$student['pix'])}}" class="student-passport img rounded-circle" height="200" width="180" />
                 
                 @else
                 <img src="{{asset('images/user.png')}}" class="student-passport img rounded-circle" height="200" width="180" />
                 @endif
                 </center>
             </div>
         </div>         
         <button type="button" onclick="$('#file').click()" class="btn btn-warning w-100 btn-sm font-weight-700"> Upload Passport </button>
         <input onchange="uploadme()" type="file" name="file" id="file" class="form-control form-control-file" style="visibility:hidden; display:none; " />
         <?php ## print_r(Session::get('temp_psp')); ?>
     </div>
     <div class="col-md-8 mt-2 offset-md-2 font-weight-600"> <div class="picture_loader text-center"></div>   </div>
    
          
 <div class="col-md-12 mb-3"> &nbsp;          
      <button class="mt-2 btn btn-primary btn-rounded btn-lg w-100 add-new-student-btn btn-lg ladda-button" data-style="expand-right" type="submit"> <strong> Submit Form  </strong></button>
   </div>
</div> <!-- ./ form-row -->