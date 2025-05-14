
<div class="modal fade result_composer" tabindex="-1" role="dialog" aria-labelledby="result_composerModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compose Result :&nbsp;<span class="stud-name"></span>  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="font-weight-600 float-left mr-3">Academic Session : <span class="session"></span></h6>
                        <h6 class="font-weight-600 float-left ml-3">Term : <span class="term"></span></h6>
                        <h6 class="font-weight-600 float-left ml-3">Subject : <span class="subject"></span></h6>
                    </div><!-- ./ col-md-12 -->
                    
                    <div class="col-md-12"> <form id="studentResultPoster" onsubmit="savePostedResult()" method="post" action="javascript:void(0)" class="needs-validation" novalidate=""> @csrf 
                            <input type="hidden" name="result-params" id="result-params" value="" /><!-- result parmeter -->
                        <div class="form-row mt-3">                            
                            <div class="col-md-4">
                                <label class="font-weight-700">1st C.A &nbsp; /&nbsp;  <span class="ca1_mark"></span> </label>
                                <input class="form-control ca1_score" type="text" name="ca1_score" id="ca1_score" value="" required="" />
                            </div>
                             <div class="col-md-4">
                                <label class="font-weight-700">2nd C.A &nbsp; /&nbsp; <span class="ca2_mark"></span>  </label>
                                <input class="form-control ca2_score" type="text" name="ca2_score" id="ca2_score" value=""  required="" />
                            </div>
                             <div class="col-md-4">
                                <label class="font-weight-700">Exam &nbsp; /&nbsp; <span class="exam_mark"></span>  </label>
                                <input class="form-control exam_score" type="text" name="exam_score" id="exam_score" value="" required=""  />
                            </div>
                        </div>
                       </form>
                    </div><!-- ./ col-md-12 -->
                    
                </div><!-- ./ row -->
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="$('form#studentResultPoster').submit()" type="button" class="btn btn-primary btn-lg result-poster-btn ladda-button" data-style="expand-right"> Update Result </button>
            </div>
        </div>
    </div>
</div>