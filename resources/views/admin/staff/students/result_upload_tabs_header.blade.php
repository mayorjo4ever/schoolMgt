<?php 
   use Carbon\Carbon;
   
   ?>
<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav mt-0 pt-0">
        <li class="nav-item">
            <a role="tab" class="nav-link active " id="tab-0" data-toggle="tab" href="#tab-content-0">
                <span class="font-weight-700">Compute Students Result Manually </span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                <span class="font-weight-700">Upload Bulk Students Result</span>
            </a>
        </li> 
         @if(Carbon::now() < $time_schedule['start_date'] )
         <li class="ml-4 mt-0 pt-0">
            <center> <span class="font-weight-bold mb-2 badge badge-info"> Uploading Starts In :</span> <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['start_date']}}" /> </center> 
        </li>
         @else 
         <li class="ml-4 mt-0 pt-0">
            <center> <span class="font-weight-bold mb-2 badge badge-danger"> Uploading Ends In :</span> <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['end_date']}}" /> </center> 
        </li>
         @endif
    </ul>
 