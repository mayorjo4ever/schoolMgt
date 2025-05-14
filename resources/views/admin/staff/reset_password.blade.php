@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
           @include('admin.arch_widgets.alert_message')
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
                <form class="needs-validation" novalidate id="resetPswForm" action="javascript:void(0)" onsubmit="handlePasswordReset()" method="post">@csrf
                    <div class="form-row">                       
                        <div class="col-md-4 mb-1">
                            <label for="code" class="h6 font-weight-bold mb-3">Current Password </label>
                            <input type="password"  name="current_password" id="current_password" onchange="" class="form-control" required="" />
                            <div class="invalid-feedback">
                               Enter Current Password
                            </div>                           
                         </div>
                         
                        <div class="col-md-4 mb-1">
                            <label for="code" class="h6 font-weight-bold mb-3">New Password </label>
                            <input type="password"  name="new_password" id="new_password" onchange="" class="form-control" required="" />
                            <div class="invalid-feedback">
                               Enter New Password
                            </div>                            
                         </div>
                       
                        <div class="col-md-4 mb-1">
                            <label for="code" class="h6 font-weight-bold mb-3">Confirm Password </label>
                            <input type="password" name="confirm_password" id="confirm_password" onchange="" class="form-control" required="" />
                            <div class="invalid-feedback">
                               Enter Confirm Password
                            </div>                            
                         </div> 
                        
                         <div class="col-md-12 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  password-reset-btn ladda-button" data-style="expand-right" type="submit"> <strong>Reset Password </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 