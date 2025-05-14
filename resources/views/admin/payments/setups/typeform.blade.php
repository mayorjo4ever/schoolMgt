 <div class="card-header"> {{$page_info['title']}} </div>
         <div class="card-body">
            <form id="paymentTypeForm" @if(!empty($payType['id'])) action="{{url('admin/setup-payment-types/'.$payType['id'])}}" @else action="{{url('admin/setup-payment-types')}} " @endif  method="post">@csrf
            <div class="form-row">
               <div class="col-md-4 mb-3">
                  <label for="title">Type Name </label>
                  <input type="text" name="payment_name" id="payment_name" class="form-control"  placeholder="e.g School Fees Charges"  @if(!empty($payType['name'])) value="{{$payType['name']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Type Name
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label for="code">Payment Code </label>
                  <input type="text" name="payment_code" id="payment_code" class="form-control"  placeholder="e.g. 1000658425" @if(!empty($payType['code'])) value="{{$payType['code']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Payment Code 
                  </div>
               </div> 
                
               <div class="col-md-3 mb-3">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100 payment-types-btn ladda-button" data-style="expand-right" type="submit"> <strong> @if(!empty($payType['id'])) Save Updates @else Create New @endif   </strong></button>
               </div>
                
                <div class="col-md-2 mb-3">     &nbsp;                        
                    <a href="{{url('admin/setup-payment-types')}}" class="mt-2 btn btn-secondary btn-lg w-100 payment-types-btn " data-style="expand-right" type="reset"> <strong> @if(!empty($payType['id'])) Cancel Update @else Clear @endif   </strong></a>
               </div>
            </div>
            </form>
         </div>
         <!-- ./ card-body -->    
