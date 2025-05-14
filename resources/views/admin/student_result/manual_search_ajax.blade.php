<?php 
    use App\Models\Level; 
    use App\Models\UsersResult;
    use App\Models\ClassRoom; 
    use App\Models\Term; 

?>
<div class="row mt-4">
    <div class="col-md-5 mt-2">
        <table class="table table-bordered sm w-100">
            <thead>
                <tr class="table-primary text-center text-uppercase">
                    <th colspan="2">Student Information </th>
                </tr>
            </thead>
            <tr>
                <td class="table-light font-weight-700">Name :</td>
                <td>{{$student['name']}}</td>               
            </tr>
            <tr>
                <td class="table-light font-weight-700">Registration No. :</td>
                <td class="text-uppercase">{{$student['regno']}}</td>               
            </tr>
            <tr>
                <td class="table-light font-weight-700">Current Level :</td>
                <td>{{Level::name($student['current_level_id'])}}</td>               
            </tr>
            <tr>
                <td class="table-light font-weight-700">Class Room :</td>
                <td>{{ClassRoom::name($student['current_class_room_id'])}}</td>               
            </tr>
            
        </table> 
    </div>
    
    <div class="col-md-7 mt-2">
        <table class="table table-bordered sm w-100">
            <thead>
                <tr class="table-success text-center text-uppercase">
                    <th colspan="3">List of Results </th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-uppercase">
                    <th>Session</th>
                    <th>Level </th>
                    <th>Terms </th>
                </tr>
            @foreach($levels as $level)
            <?php 
                $terms = UsersResult::where([
                    'user_id'=>$student['id'],
                    'regno'=>$student['regno'],
                    'session'=>$level['session'],
                    'level_id'=>$level['level_id']])->groupBy('term')->pluck('term');           ?>
            <!-- -->
            <tr>
                <td class="table-light font-weight-500 w-32"> {{$level['session']}}</td>
                <td class="font-weight-500 w-32"> {{Level::name($level['level_id'])}} </td>               
                <td class="table-light font-weight-500 w-32"> 
                   @foreach($terms as $term)
                    <?php $token = base64_encode(base64_encode($student['regno'])."**".base64_encode($level['session'])."**".base64_encode($term))?>
                    <a href="{{url("admin/student-per-term-result/".$token)}}" target="_blank" class="btn btn-success btn-lg font-weight-700">{{Term::name($term)}}&nbsp;Term  </a> 
                    @endforeach
                </td>               
            </tr>
           @endforeach
            </tbody>
            
        </table> 
    </div>
    
</div>