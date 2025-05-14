<?php use Carbon\Carbon; 
      use App\Models\Country;
      use App\Models\State;
      use App\Models\City; 
      use App\Models\Level; 
      use App\Models\LevelCategory; 
      use App\Models\ClassRoom; 
      use App\Models\Term; 
      
?>
<div class="col-xl-8 col-sm-12 col-md-6">
  <div class="card mb-2"> <div class="card-body"> 
     <h4 class="mb-1 card-title"> Brief Info </h4>
  <div class="row">
      <table class="table table-bordered table-striped table-sm w-100 m-2 p-2">
          <tbody>
              <tr>                  
                  <td colspan="2" class="pl-4 font-weight-400 text-uppercase bg-deep-blue" >
                    <center>  @if(!empty($me['pix']))
                        <img src="{{asset('images/students/passports/'.$me['pix'])}}" class="img rounded-circle img-thumbnail" />
                       @else 
                       <img src="{{asset('images/user.png')}}" class="img rounded-circle img-thumbnail"/>
                       @endif
                    </center>        
          </td>
              </tr>
              <tr>
                  <td class="pl-4 font-weight-500 text-uppercase">ID No. </td>
                  <td class="pl-4 font-weight-400 text-uppercase font-weight-700">{{$me['regno']}}</td>
              </tr>
              <tr>
                  <td class="pl-4 font-weight-500 text-capitalize">Full Name: </td>
                  <td class="pl-4 font-weight-400 text-capitalize font-weight-700">{{$me['name']}}</td>
              </tr>
              <tr>
                  <td class="pl-4 font-weight-500 text-capitalize">Gender: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{$me['gender']}}</td>
              </tr>
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Date of Birth: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Carbon::parse($me['dob'])->toDayDateTimeString() }}
                  -- {{Carbon::parse($me['dob'])->diffForHumans()}}
                  </td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Email: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{$me['email'] }}                  
                  </td>
              </tr>
              
                <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Phone No: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{$me['mobile'] }}                  
                  </td>
              </tr>
              
               <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Country: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Country::name($me['country_id']) }}                  
                  </td>
              </tr>

              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">State: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{State::name($me['state_id']) }}                  
                  </td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">City: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{City::name($me['city_id']) }}                  
                  </td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Home Residence: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{$me['residence'] }}                  
                  </td>
              </tr>
              
          </tbody>
      </table>      
     </div></div>
  </div> <!-- ./ card  -->
  
   <div class="card mb-3"> <div class="card-body"> 
     <h4 class="font-weight-bold text-uppercase card-title">admission info</h4>
  <div class="row"> 
  
  <table class="table table-bordered table-striped table-sm w-100 m-2 p-2">
          <tbody>
              <tr>
                  <td class="pl-4 font-weight-500 text-capitalize">Session of Entry. </td>
                  <td class="pl-4 font-weight-400 text-uppercase">{{$me['session_of_entry']}}</td>
              </tr>
              <tr>
                  <td class="pl-4 font-weight-500 text-capitalize">Term  of Entry: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Term::name($me['term_of_entry'])}} term </td>
              </tr>
              <tr>
                  <td class="pl-4 font-weight-500 text-capitalize">Level of Entry: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Level::name($me['level_admitted'])}}</td>
              </tr>
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Classroom Admitted: </td>
                   <td class="pl-4 font-weight-400 text-capitalize">{{ClassRoom::name($me['class_room_admitted'])}}</td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Category: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{LevelCategory::name($me['level_category_admitted']) }}                  
                  </td>
              </tr>
              
                <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Current Level: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Level::name($me['current_level_id']) }}                  
                  </td>
              </tr>
              
               <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Current Class Room: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{ClassRoom::name($me['current_class_room_id']) }}                  
                  </td>
              </tr>

              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Category: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{LevelCategory::name($me['current_level_category_id']) }}                  
                  </td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Date Admitted: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{Carbon::parse($me['date_admitted'])->toDayDateTimeString() }}                  
                  </td>
              </tr>
              
              <tr> 
                  <td class="pl-4 font-weight-500 text-capitalize">Created By: </td>
                  <td class="pl-4 font-weight-400 text-capitalize">{{admin_info($me['recorded_by'])['fullname'] }}                  
                  </td>
              </tr>
              
          </tbody>
      </table>
           
     </div></div>
  </div> <!-- ./ card  -->
  
</div>
 