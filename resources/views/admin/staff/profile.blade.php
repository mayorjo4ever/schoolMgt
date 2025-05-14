<div class="row">
	 @foreach($admins as $admin)
   <div class="col-sm-12 col-md-6 col-xl-4">
      <div class="card-shadow-primary card-border mb-3 profile-responsive card">
         <div class="dropdown-menu-header">
            <div class="dropdown-menu-header-inner bg-alternate">
               <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/abstract1.jpg');"></div>
               <div class="menu-header-content btn-pane-right">
                  <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                     <div class="avatar-icon rounded">
                       @if(!empty($admin['pix']))
                       <img src="{{asset('images/staff/passports/'.$admin['pix'])}}" />
                       @else 
                       <img src="{{asset('images/user.png')}}" />
                       @endif
                      </div>
                  </div>
                  <div> <?php $profile =  admin_info($admin['id']); ?>
                     <h5 class="menu-header-title"> {{$profile['fullname']}}</h5>
                     <h6 class="menu-header-subtitle"> {{$profile['email']}}</h6>
                  </div>
                  <div class="menu-header-btn-pane">
                     <a admin_id="{{ $admin['id']}}" target="_blank" href="{{url('admin/add-edit-staff/'.$admin['id']) }}"  class="btn-wide btn-hover-shine btn-pill btn btn-warning font-weight-bold text-uppercase">{{$profile['regno']}}</a>
                  </div>
               </div>
            </div>
         </div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item">
               <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                  <div class="text-center">
                     <h5 class="widget-heading opacity-10 mb-0 font-weight-600"> <i class="pe-7s-call font-weight-600"></i>&nbsp; {{$profile['mobile']}}</h5>
                  </div>
               </div>
            </li>
            <li class="p-0 list-group-item">
               <div class="grid-menu grid-menu-2col">
                  <div class="no-gutters row">
                    @php $roles = adminRoles($admin['id'],false) @endphp
                    @foreach($roles as $role)
                     <div class="col-sm-6 ">
                        <a admin_id="{{ $admin['id']}}"  target="_blank" href="{{url('admin/staff/assign-role/'.$admin['id']) }}" class="btn-icon-vertical font-weight-600 text-dark btn-square btn-transition br-bl btn btn-outline-link">
                        <i class=" pe-7s-door-lock pe-2x btn-icon-wrapper btn-icon-lg mb-3"> </i> {{$role}}
                        </a>
                     </div>
                    @endforeach					 
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
   @endforeach
</div>
