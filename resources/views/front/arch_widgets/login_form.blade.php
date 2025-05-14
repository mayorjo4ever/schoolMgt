<form class="needs-validation" novalidate id="loginForm" action="javascript:;" method="post">@csrf
    <div class="row mt-0 pt-0">
       
   <div class="col-lg-6 offset-lg-3 h-100"><br/>       
      <!-- <div id="login-message" class="  mt-5 w-75 ml-lg-5 alert alert-danger alert-dismissible fade show"> 
          <span class="message"></span>                 
    </div>-->
   <div class="card mb-4 w-100  ml-lg-5 bg-heavy-rain"><div class="card-body">
     <!--<center><h4 class="card-title"> {{ env('APP_NAME') }} &nbsp; <span class="pe-7s-key pe-2x font-weight-bolder"></span> &nbsp; Administrator Login</h4> </center>-->
      <div class="form-row"> 
          <div class="col-md-12">
              <h6 class="align-left text-uppercase font-weight-bolder"> &nbsp; {{str_replace('_',' ',env('APP_NAME'))}}</h6>
          </div>
          
          <div class="col-md-4 mt-2">           
            <input type="text" name="username" id="username" class="form-control"  placeholder="Username / Email " required >
            <div class="invalid-feedback">
               Provide Your Email / Username 
            </div>
         </div> <!-- ./ col-md-4 -->  
        
         <div class="col-md-4 mt-2 ">            
           <input type="password" name="password" id="user-password" class="form-control" placeholder="Password" required >
            <div class="invalid-feedback">
               Provide Your Password
            </div>
         </div> <!-- ./ col-md-4 -->
         
         <div class="col-md-3 ">
         <button class="pt-2 mt-2 mb-3 btn btn-secondary btn-shadow btn-lg w-100  login-btn ladda-button" data-style="expand-right" type="submit"> <strong>  Login  </strong></button>
          </div> <!-- ./ col-md-3 -->  
         
      </div><!-- ./ form-row -->
    </div>
</div></div>

</div>    

</form>