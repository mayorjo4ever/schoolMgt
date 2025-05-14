<?php 
    use App\Models\Level; 
    use App\Models\ClassRoom; 
    use App\Models\Subject; 
    use Carbon\Carbon;  
    use App\Models\ClassAttendanceLog;
    
    $days = workingDays(); 
    ## $attendantDays = ClassAttendanceLog::DaysOpened($data['session'], $data['term'], $data['classroom']); 
?>

<table class="table mt-3 font-weight-600 table-bordered border border-success ">
        <tr><th class="text-uppercase text-right"> <?php  $w = 0; $wk =1;  echo "Week ". ($wk);?>  <br/> Attendance </th> 
            
            @foreach($days as $day)
            
               <?php  $this_week = "";  ?> 
            
             <?php if(in_array($day,$attendance_dates)) :
                 $attendance_taken = "table-success "; 
                else:
                  $attendance_taken = "table-light "; 
            endif; 
                
            if($wk == weeks_spent_in_term()) $this_week = "border-dark"; 
            ?>
            
            <th class="text-uppercase {{ $this_week }} {{ $attendance_taken }} ">
                {{Carbon::parse($day)->dayName }}  <br/>
                {{ $day }} 
                &nbsp; 
            </th>
            <?php $w++; ?>  <!--  break the days into weeks by tr -->
            <?php if($w%5 == 0 && $wk < weeks_in_term()):  $wk++; ?>
            </tr><tr>
               <th class="text-uppercase text-right">  <?php echo "Week ". ($wk);?>   <br/> Attendance </th> 
            <?php endif; ?>
            @endforeach
        </tr> 
        
        
</table>