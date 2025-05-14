<form class="needs-validation" novalidate id="forgotPswForm" action="javascript:;" method="post">@csrf
    <div class="row mt-0 pt-0">
       
   <div class="col-lg-6 h-100"><br/>             
   <div class="card mb-4 w-100  ml-lg-5  bg-night-sky bg-tr"><div class="card-body">
   
      <div class="form-row"> 
          <div class="col-md-12">
              <h6 class="align-left text-uppercase font-weight-bolder text-white">  &nbsp;  Reset Password </h6>
          </div>
          
          <div class="col-md-6 mt-2">           
            <input type="text" name="email" id="username" class="form-control"  placeholder="Email Address" required >
            <div class="invalid-feedback">
                <span class="admin_email_error error-text" style="color:yellow;" >Provide Your Email / Username </span>
            </div>
         </div> <!-- ./ col-md-4 -->  
         
         <div class="col-md-6 ">
         <button class="pt-2 mt-2 mb-3 btn btn-warning btn-shadow btn-lg forgot-btn w-50 ladda-button" data-style="expand-right" type="submit"> <strong> Reset  </strong></button>
                   
          </div> <!-- ./ col-md-3 -->  
          <span class="font-weight-600 text-warning"> Have Account  ? ...</span> &nbsp; 
          <span><a href="{{url('portal/login')}}" class="font-weight-bolder pull-left" style="color:yellow;" >Login Here.. </a></span>
          
      </div><!-- ./ form-row -->
    </div>
</div></div>

</div>    

</form>