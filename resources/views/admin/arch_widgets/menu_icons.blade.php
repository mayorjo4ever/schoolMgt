<?php 
use App\Models\Term; 
?>
<div class="col-xl-12 col-sm-12 col-md-12">
  <div class="card">
      <div class="card-header card-header-pills card-shadow-alternate bg-malibu-beach">
        <h4 class="m-2 card-title text-dark"> Quick Info </h4>
      </div>
      <div class="card-body"> 
   
  <div class="row">
    <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-happy-fisher">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">This Session</div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-date pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{current_session()}}</span></div>
                </div>
            </div>
        </div>
    </div>  
      
      
    <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-deep-blue">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">This Term </div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-date pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{Term::name(current_term()) }} Term</span></div>
                </div>
            </div>
        </div>
    </div>  
    
      <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-happy-green text-white">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-white">Total Students </div> 
                    <div class="widget-subheading"><i class="pe-7s-users pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-white"> {{count_total_students()  }} </span></div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-night-sky  text-white">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-white">Total Staff </div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-users pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-white"> {{count_total_admins()  }} </span></div>
                </div>
            </div>
        </div>
    </div>
      @can('view-admin')  @endcan   
       
    <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-warm-flame">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">Total Subjects</div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-notebook pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{count_total_subjects()}}</span></div>
                </div>
            </div>
        </div>
    </div>
     
       <div class="col-sm-6 col-xl-4">
        <div class="card mb-3 widget-content bg-arielle-smile ">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">Total Classrooms</div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-home pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{count_total_classrooms()}}</span></div>
                </div>
            </div>
        </div>
    </div>
   
   
        <div class="col-sm-12 col-xl-6">
        <div class="card mb-3 widget-content bg-arielle-smile ">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">Days Spent This Term </div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-date pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{ days_spent_in_term() }} of {{days_in_term()}}</span></div>
                </div>
            </div>
        </div>
    </div>
             
    <div class="col-sm-12 col-xl-6">
        <div class="card mb-3 widget-content bg-warm-flame">
            <div class="widget-content-wrapper text-dark">
                <div class="widget-content-left">
                    <div class="widget-heading mb-2 text-dark">Weeks Spent In Term </div> 
                    <div class="widget-subheading opacity-100"><i class="pe-7s-date pe-2x font-weight-bold  btn-icon-wrapper"> </i> </div>
                </div>
                <div class="widget-content-right mt-2">
                    <div class="widget-numbers"> <span class="text-dark"> {{ weeks_spent_in_term() }} of {{weeks_in_term()}}</span></div>
                </div>
            </div>
        </div>
    </div>
          
   <div class="col-sm-6 col-xl-4">
       <a onclick="return confirm('Do You Want To Logout Now ?')" href="{{url('portal/logout')}}" class="btn-icon-vertical mb-3 btn-transition btn-block btn btn-danger font-weight-bold">
      <i class="pe-7s-power pe-2x font-weight-bold btn-icon-wrapper"> </i>
      Logout
      </a>
   </div> <!-- col-sm-6 -->
   
     </div></div>
  </div> <!-- ./ card  -->
</div>
 