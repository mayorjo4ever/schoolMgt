 <div class="card-header"> {{$page_info['title']}} </div>
         <div class="card-body">
            <form id="payment-amount-setup" action="javascript:void(0)"  method="post">@csrf
            <div class="form-row">
                <div class="col-md-3 mb-1">
                    <label for="title" class="font-weight-600">Academic Session </label>
                  <select name="session" class="form-control">
                      <option value="">... </option>
                    @foreach($sessions as $sess)
                    <?php $sess = $sess."/".($sess+1);?>
                    <option value="{{$sess}}" @selected($sess == Session::get('payment_session')) > {{$sess}} </option> 
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                     Select Academic Session
                  </div>
                </div> <!-- ./ col-md-3  -->
                
               <div class="col-md-3 mb-1">
                  <label for="title" class="font-weight-600" >Select Payment Type  </label>
                  <select name="payment_type" class="form-control">
                      <option value="">... </option>
                      @foreach($all_pay_types as $k=>$pay_type)
                      <option value="{{$pay_type['id']}}"  @selected($pay_type['id'] == Session::get('payment_type')) >{{$pay_type['name']}} </option>
                      @endforeach
                      
                  </select>
                  <div class="invalid-feedback">
                     Select Payment Type 
                  </div>
               </div> 
                
                 <div class="col-md-3 mb-1">
                    <label for="levels" class="font-weight-600">Class Level </label>
                        <select name="level" class="form-control">
                            <option value="">... </option>
                          @foreach($levels as $level)                         
                          <option value="{{$level['id']}}" @selected($level['id'] == Session::get('payment_level')) > {{$level['name']}} </option> 
                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                           Select Class Level
                        </div>
                      </div> <!-- ./ col-md-3  -->           
                
               <div class="col-md-3 mb-1">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100 search-payment-amount-setup-btn ladda-button" data-style="expand-right" type="submit"> <strong> View Setup  </strong></button>
               </div>
            </div>
            </form>
         </div>
         <!-- ./ card-body -->    
