<div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
   <div class="row">
      <div class="col-md-12">
         <div class="mb-3 card">
            <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Enter Student Registration Number  </div>
            <div class="card-body">
                <!-- start body form --> 
                <form method="post" onsubmit="handleManualResultSearch()" class="needs-validation" novalidate="" action="javascript:void(0)" >@csrf
                <div class="form-row">
                   <div class="col-md-4 mb-1">
                      <label for="title"  class="font-weight-bold"> Registration Number </label>
                      <input type="text" name="regno" id="regno" class="form-control bg-white"  placeholder="Registration Number"  value="" required >
                      <div class="invalid-feedback">
                         Enter Registration Number
                      </div>
                   </div>
                    <div class="col-md-2 mt-2"> &nbsp;                        
                      <button class=" btn btn-primary btn-lg w-100  stud-result-manual-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> Search &nbsp; <span class="pe pe-7s-search"></span> </strong></button>
                   </div>
                </div>
                <!-- ./ form-row -->               
                </form>
               <div class="manual-search-result"></div>
               
            </div>
            <div class="d-block card-footer text-capitalize">              
                <p>enter the registration number and click search to show list of students results </p>
            </div>
         </div>
      </div>
      <!-- ./ col-md-12 --> 
   </div>
   <!-- ./ row -->
</div>
<!-- ./ tab-pane -->
