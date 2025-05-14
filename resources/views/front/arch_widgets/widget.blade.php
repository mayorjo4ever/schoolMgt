<div class="row">
   <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-grow-early">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Current Session </div>
               <div class="widget-subheading">We are running : </div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{ current_session() }}</span></div>
            </div>
         </div>
      </div>
   </div>
    
   <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-midnight-bloom">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Current Term </div>
               <div class="widget-subheading">Last year expenses</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{ nth(current_term()) }}</span></div>
            </div>
         </div>
      </div>
   </div>
    
   <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-royal">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Total Users</div>
               <div class="widget-subheading">Total Clients Profit</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{number_format($users ?? 0 )}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-grow-early">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Questions</div>
               <div class="widget-subheading">People Interested</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-white"><span>{{number_format($qtns ?? 0)}}</span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-premium-dark">
         <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
               <div class="widget-heading">Products Sold</div>
               <div class="widget-subheading">Revenue streams</div>
            </div>
            <div class="widget-content-right">
               <div class="widget-numbers text-warning"><span>$14M</span></div>
            </div>
         </div>
      </div>
   </div>
</div>
