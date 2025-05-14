<?php    
    use App\Models\ClassRoom; 
    use App\Models\Subject; 
    use App\Models\UsersResult; 
    use App\Models\TestExamMarks; 
    use App\Models\SubjectGrade; 
    
    ## print "<pre>"; 
    ## print_r($mystudents); die; 
    $mark_settings = TestExamMarks::getSetings();
?>

<div class="table">
    
    <table class="table table-bordered table-hover  table-sm dataTable">
        <thead>
            <tr class="table-primary">
                <th>S/N</th>
                <th>Reg No</th>
                <th>Name</th>   
                <th>Subject </th>  
                <th>Class room </th>    
                <th>1st C.A / {{$mark_settings['ca_1']}}  </th>     
                <th>2nd C.A / {{$mark_settings['ca_2']}}</th>     
                <th>Exam / {{$mark_settings['exam']}}</th>     
                <th>Total / 100 </th>     
                <th>Grade </th>     
                <th>Action </th>     
            </tr>
        </thead>
        <tbody> <?php $n=0; $subjectName = Subject::subjectName($data['subject']);
        ?>
            @foreach($mystudents as $k=>$student)
            <?php $stud_courses = explode(',',$student['subject_ids']); $total = "";  ?> 
           @if(in_array($data['subject'],$stud_courses))
           
           <tr> <input type="hidden" name="subject_id" value="{{$data['subject']}}" class="w-32" />
                 <?php 
                        $myDataText = $student['user_id']."**".$student['regno']; 
                        $myDataText .= "**".users_name($student['user_id']);
                        $myDataText .= "**".$data['acad_session']."**".$data['term'];
                        $myDataText .="**".$data['subject'];
                        
                        $myscore = UsersResult::where([
                            'user_id'=>$student['user_id'],
                            'regno'=>$student['regno'],
                            'session'=>$data['acad_session'],
                            'term'=>$data['term'],
                            'subject_id'=>$data['subject'],
                        ])->get()->first();
                    ?>
                <td>{{ $n +1 }} </td>
                <td class="text-uppercase"> {{ $student['regno']}}</td>
                <td>{{ users_name($student['user_id'])}}</td>     
                <td>{{$subjectName}}</td> 
                <td> {{ ClassRoom::name($student['class_room_id'])}}</td>                          
                <td class="text-center font-weight-600"> {{$myscore['ca_1']??""}} </td> 
                 <td class="text-center font-weight-600"> {{$myscore['ca_2']??""}} </td> 
                 <td class="text-center font-weight-600"> {{$myscore['exam']??""}}</td>                   
                 <td class="text-center font-weight-600"> @if(!empty($myscore)) {{ $total = $myscore['exam'] + $myscore['ca_2'] + $myscore['ca_1'] }} @endif </td>  
                 <td class="text-center font-weight-600"> {{  $grade = SubjectGrade::get_grade($total)[0]; }}</td>  
                 <td><button {{ $upload_readonly }} type="button" onclick="result_composer_setting('{{$myDataText}}')" data-toggle="modal" data-target=".result_composer" class="btn btn-primary btn-lg  w-100" style="width:200px;"> Edit &nbsp; <span class="pe pe-7s-pen"></span> </button> </td>              
              
            </tr> <?php $n++; ?>
           
            @endif
            @endforeach 
            @if(count($mystudents) == 0 )
             <tr>
                 <td colspan="11" class="text-dark text-center"> No Student Found &nbsp; <span class="pe pe-7s-search pe-2x"></span> </td>
             </tr>             
            @endif
            
        </tbody>
    </table>
</div>