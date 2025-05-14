<?php 
    use App\Models\Level; 
    use App\Models\ClassRoom; 
?>
 
<div class="row">
<div class="col-sm-12 col-md-6 col-xl-4">
      <div class="card-shadow-primary card-border mb-3 profile-responsive card">
         <div class="dropdown-menu-header">
            <div class="dropdown-menu-header-inner bg-alternate">
               <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/abstract1.jpg');"></div>
               <div class="menu-header-content btn-pane-right">
                  <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                     <div class="avatar-icon rounded">
                        @if(!empty($me['pix']))
                       <img src="{{asset('images/students/passports/'.$me['pix'])}}" />
                       @else 
                       <img src="{{asset('images/user.png')}}" />
                       @endif
                     </div>
                  </div>
                  <div> <?php  ?>
                     <h5 class="menu-header-title"> {{$me['name']}}</h5>
                     <h6 class="menu-header-subtitle"> {{$me['email']}}</h6>
                  </div>
                  <div class="menu-header-btn-pane">
                      <a href="#" class="btn-wide btn-hover-shine btn-pill btn btn-warning font-weight-bold text-uppercase"> <i class="pe-7s-id font-weight-bold" style="font-size: 18px;"> </i> &nbsp;&nbsp; {{$me['regno']}}</a>
                  </div>
               </div>
            </div>
         </div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item">
               <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                  <div class="text-center">
                     <h5 class="widget-heading opacity-10 mb-0"> <i class="pe-7s-call "></i>&nbsp; {{$me['mobile']}}</h5>
                  </div>
               </div>
            </li>
            <li class="p-0 list-group-item">
               <div class="grid-menu grid-menu-2col">
                  <div class="no-gutters row">
                     <div class="col-sm-6">
                         <a href="#" class="btn-icon-vertical btn-square btn-transition br-bl btn btn-outline-link">
                        <i class=" pe-7s-study pe-2x font-weight-bold btn-icon-wrapper btn-icon-lg mb-3"> </i> 
                        <span class=" text-dark font-weight-bold ">  Student </span>
                        </a>
                     </div>   <!-- ./ col-sm-6 -->
                     
                     <div class="col-sm-6">                           
                         <button class="btn-icon-vertical btn-square btn-transition br-br btn btn-outline-link">
                            <i class="pe-7s-graph3 pe-2x font-weight-bold btn-icon-wrapper btn-icon-lg mb-3"> </i>  
                            <span class=" text-dark font-weight-bold "> Level : {{ Level::name($me['current_level_id'])}}</span>
                        </button> 
                     </div>    <!-- ./ col-sm-6 -->
                    
                     <div class="col-sm-6">                           
                         <button class="btn-icon-vertical btn-square btn-transition br-br btn btn-outline-link">
                            <i class=" pe-7s-map-marker pe-2x font-weight-bold btn-icon-wrapper btn-icon-lg mb-3"> </i>  
                            <span class=" text-dark font-weight-bold "> Class Room :  {{ ClassRoom::name($me['current_class_room_id'])}} </span>
                        </button> 
                     </div>   <!-- ./ col-sm-6 -->
                     
                     <div class="col-sm-6">                           
                         <button class="btn-icon-vertical btn-square btn-transition br-br btn btn-outline-link">
                            <i class="pe-7s-box1 pe-2x font-weight-bold btn-icon-wrapper btn-icon-lg mb-3"> </i>  
                            <span class=" text-dark font-weight-bold "> Category :  {{ ClassRoom::name($me['current_class_room_id'])}} </span>
                        </button> 
                     </div>   <!-- ./ col-sm-6 -->  
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
    
    @include('front.profile.profile_table')
  

</div> <!-- ./ row -->