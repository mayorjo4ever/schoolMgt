<table>
    <thead>
        <tr>
            <th>REGNO</th>
            <th>1ST CA</th>
            <th>2ND CA</th>
            <th>EXAM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <?php $stud_courses = explode(',',$student['subject_ids']);  ?> 
           @if(in_array($subject,$stud_courses))           
            <tr>
                <th>{{$student->regno}}</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>