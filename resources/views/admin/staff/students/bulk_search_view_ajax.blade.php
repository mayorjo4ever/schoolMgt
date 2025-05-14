<?php    
    use App\Models\ClassRoom; 
    use App\Models\Subject;  
    use App\Models\Term; 
     
?>

<div class="table">
    <form  class="needs-validation" novalidate method="post" action="{{url('admin/student-result/read-excel')}}" enctype="multipart/form-data"> @csrf 
    <table class="table table-bordered table-hover  table-sm">
        <thead>  <?php $n=0; $subjectName = Subject::name($data['subject']);
        
        ?>
            <tr class="table-primary m-2 p-2">                 
                <th colspan="10" class=" m-3 p-3" >Upload CSV File For {{$subjectName}}  - {{$data['acad_session']}} - {{ ClassRoom::name($data['class-room'])}}
                    - {{Term::name($data['term'])}} Term Result
                </th>     
            </tr>
        </thead>
        <tbody>              
             @if(count($mystudents) > 0 )
            <tr> 
                <input type="hidden" name="session" value="{{$data['acad_session']}}"  />
                <input type="hidden" name="term" value="{{$data['term']}}"  />
                <input type="hidden" name="class-room" value="{{$data['class-room']}}"  />
                <input type="hidden" name="subject_id" value="{{$data['subject']}}"  />
                
                <td  align="center" class="m-5 p-3 h-50 table-dark text-white font-weight-bold">
                  Attach CSV File <br/> 
                  <span class="mt-5 pt-5 text-sm small"> {{ count($mystudents) }} Student(s) Found </span>
                </td>
                <td  align="center" class="mt-5 mb-5">
                    <input {{ $upload_readonly }} type="file" required="" name="file" class="form-control-file form-control form-control-lg" />
                </td>
                
            </tr>
            <tr><?php $download_token = base64_encode($data['acad_session']."**".$data['class-room']."**".$data['subject']);   ?>
                <td> <a {{ $upload_readonly }} href="{{url('admin/download-result-template/'.$download_token)}}" target="_blank" class="btn btn-outline-info btn-lg font-weight-bold btn-block"> Download List of Students  </a> </td>
                <td><button {{ $upload_readonly }} type="submit" class="btn btn-success btn-lg  p-2 w-100 font-weight-bold" > Upload &nbsp;{{$subjectName}}&nbsp;for &nbsp; {{ ClassRoom::name($data['class-room'])}}  <span class="pe pe-7s-play  font-weight-bold"></span> </button>
                </td>
            </tr>
             @else
           
             <tr>
                 <td colspan="11" class="text-dark text-center"> No Student Found &nbsp; <span class="pe pe-7s-search pe-2x"></span> </td>
             </tr>             
            @endif
            
        </tbody>
    </table>
    </form>
</div>