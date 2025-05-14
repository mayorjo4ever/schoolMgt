<?php 
    use App\Models\Level; 
    use App\Models\ClassRoom; 
    use App\Models\Subject; 
    use Carbon\Carbon;     
?>

 <form method="post" id="student_attendance_list" onsubmit="submitClassAttendance()" action="javascript:void(0)">@csrf
     
<h6 class="title mt-4 mb-3 font-weight-700 text-uppercase "> Take attendance for the following students : Today : {{ Carbon::parse($data['date'])->toDayDateTimeString() }} </h6>
<div class="table">
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="bg-dark text-white">
                <th>S/N</th>
                <th>Reg No</th>
                <th>Name</th>                                 
                <th>Class room</th>                          
                <th>Present / Absent</th>
                <th>Remarks</th>                                          
            </tr>
        </thead>
        <tbody> 
           @if(count($mystudents) > 0 ) 
           <?php 
            $param = $data['session']."|".$data['term']."|".$data['classroom']."|".$data['date']; 
            $sparam = base64_encode($param); ## secured param
           ?>
           
        <input type="hidden" name="params" id="params" value="{{$sparam}}" />         
           
            @foreach($mystudents as $k=>$student)
            <?php $am_present = false;   ?> 
             @if(!empty($attendanceLog))
                     @if(in_array($student['regno'], $attendants))
                       <?php  $remarks = "Present"; $am_present = true;  ?>
                     @else 
                       <?php  $remarks = "Absent"; $am_present = false; ?>
                     @endif
                   @endif
           <tr>
                <td>{{ $k +1 }}</td>
                <th class="text-uppercase"> {{ $student['regno']}}</th>
                <th>{{users_name($student['user_id'])}}</th> 
                <td> {{ ClassRoom::name($student['class_room_id'])}}</td>                          
                <td class=""> 
                    <div class="form-group row ml-3 mt-1">
                        <label class="switch pull-right">  
                            <input type="checkbox"  @if(!empty($attendanceLog)) disabled="" @endif onchange="toggleAttendanceRow($(this))" name="students[]" value="{{$student['user_id']}}" @if($am_present) checked @endif >
                        <span class="slider round"></span>
                        </label> &nbsp; <span class=" pull-right bold">&nbsp; &nbsp;  </span>
                     </div>
                </td>        
                <td>{{$remarks ??"" }}</td>
            </tr>    
            @endforeach 
            
            @if(!empty($attendanceLog))
            <tr>
                <td colspan="6" align="center"> 
                    <button disabled="" type="button" class="btn btn-dark btn-lg w-50 btn-block"> Attendance Has Been Taken </button>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="6" align="center"> 
                    <button type="submit" class="btn btn-success btn-lg w-50 btn-block"> Save Attendance </button>
                </td>
            </tr>
            @endif 
            
           @else 
             <tr>
                 <td colspan="6" class="text-dark text-center"> No Student Found &nbsp; <span class="pe pe-7s-search pe-2x"></span> </td>
             </tr>             
           @endif
            
        </tbody> 
             
    </table>
    
    <table class="table mt-5 font-weight-600 table-borderless border border-dark">
        <tr><th colspan="2" align="center" class="text-uppercase text-center"> Report Summary: </th> </tr> 
        <tr><td align="right" class="w-50"> Attendants Taken : </td> <td align="left"  class="w-50">  @if(empty($attendanceLog)) No @else Yes @endif  </td></tr>
        <tr><td align="right"> Time Taken : </td> <td align="left"> @if(!empty($attendanceLog)) {{  Carbon::parse($attendanceLog[0]['updated_at'])->diffForHumans() }} @else -- : -- @endif  </td></tr>
        <tr><td align="right"> Total Students in Class : </td> <td align="left"> {{ $totalStudent = count($mystudents)  }} </td></tr>
        <tr><td align="right"> Total Students Present : </td> <td align="left"> @if(!empty($attendanceLog)) {{ $presents = count($attendants) }} @else --:-- @endif </td></tr>
        <tr><td align="right"> Total Students Absent : </td> <td align="left"> @if(!empty($attendanceLog)) {{ $totalStudent - $presents }} @else --:-- @endif </td></tr>
        <tr><td align="right"> Attendance Taken By : </td> <td align="left"> @if(!empty($attendanceLog)) {{ admin_info($attendanceLog[0]['taken_by'])['fullname']}} @else --:-- @endif </td></tr>         
    </table>
    
    @include('admin.student_attendance.attendance_analysis')
</div>
</form>
        
   


