<?php 
    use App\Models\Level; 
    use App\Models\ClassRoom; 
    use App\Models\Subject; 
    
?>
<h6 class="title mt-2 mb-3 font-weight-700 text-uppercase "> Students Offering :  </h6>
<div class="table">
    
    <table class="table table-bordered table-sm dataTable">
        <thead>
            <tr class="table-primary">
                <th>S/N</th>
                <th>Reg No</th>
                <th>Name</th>
                <th>Level</th>                    
                <th>Class room </th>                          
                <th>Subjects </th>                          
                <th>Last Registration Date  </th> 
            </tr>
        </thead>
        <tbody> 
            @foreach($mystudents as $k=>$student)
            <?php $stud_courses = explode(',',$student['subject_ids']);   ?> 
          
            <tr>
                <td>{{ $k +1 }}</td>
                <td class="text-uppercase"> {{ $student['regno']}}</td>
                <td>{{users_name($student['user_id'])}}</td>
                <td>{{Level::name($student['level_id'])}}</td>                    
                <td> {{ ClassRoom::name($student['class_room_id'])}}</td>                          
                <td> 
                    @foreach($mysubjects as $ms)
                        @if(in_array($ms,$stud_courses))
                        <span class="badge badge-success"> {{Subject::subjectCode($ms)}}</span>
                        &nbsp; 
                        @endif
                    @endforeach
                </td>                          
                <td>  
                    {{ \Carbon\Carbon::parse($student['updated_at'])->diffForHumans()}}
                </td>                  
            </tr>    
            @endforeach 
           @if(count($mystudents) == 0 )
             <tr>
                 <td colspan="6" class="text-dark text-center"> No Student Found &nbsp; <span class="pe pe-7s-search pe-2x"></span> </td>
             </tr>             
              @endif
            
        </tbody>
    </table>
</div>

        
   


