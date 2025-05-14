 <div class="card-header"> {{$page_info['title']}} </div>
         <div class="card-body">
            <form id="paymentTypeForm" @if(!empty($payItem['id'])) action="{{url('admin/payment-items/'.$payItem['id'])}}" @else action="{{url('admin/payment-items')}} " @endif  method="post">@csrf
            <div class="form-row">
               <div class="col-md-4 mb-3">
                  <label for="title">Type Name </label>
                  <input type="text" name="item_name" id="item_name" class="form-control"  placeholder="e.g School Fees"  @if(!empty($payItem['name'])) value="{{$payItem['name']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Type Name
                  </div>
               </div>
               
               <div class="col-md-3 mb-3">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100 payment-types-btn ladda-button" data-style="expand-right" type="submit"> <strong> @if(!empty($payItem['id'])) Save Updates @else Create New @endif   </strong></button>
               </div>
                
                <div class="col-md-3 mb-3">     &nbsp;                        
                    <a href="{{url('admin/payment-items')}}" class="mt-2 btn btn-secondary btn-lg w-100 payment-types-btn " data-style="expand-right" type="reset"> <strong> @if(!empty($payItem['id'])) Cancel Update @else Clear @endif   </strong></a>
               </div>
            </div>
            </form>
         </div>
         <!-- ./ card-body -->    
