<?php
# use Carbon\Carbon; 
# use App\Models\Schedule; 

use App\Models\AcademicCalendar;
use App\Models\Admin;
use App\Models\Answer;
use App\Models\ClassRoom;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
##use Illuminate\Support\Number; 

    
  function greetings(){
    $now = Carbon::now(); $message = ""; 
    if($now->hour < 12 ) { $message = "Morning"; }
    else if($now->hour < 18 ) { $message = "Afternoon"; }
    else { $message = "Evening"; }
    return "Good $message : "; 
}

    function current_session(){
        if(empty(Session::get('calendar')))
            { 
                Session::put('calendar',AcademicCalendar::first()->toArray());         
            }
            return Session::get('calendar')['current_session']; 
    }

    function current_term(){
        if(empty(Session::get('calendar')))
            { 
                Session::put('calendar',AcademicCalendar::first()->toArray());         
            }
            return Session::get('calendar')['current_term']; 
    }
    
    function days_spent_in_term(){
        $start = Carbon::parse(Session::get('calendar')['term_begins']);
        $ends = Carbon::now();
        $days = $start->diffInDaysFiltered(function(Carbon $date){
            return !$date->isWeekend();
        },$ends); 
        return $days; 
    }      
    
   
    
     function days_in_term(){
        $start = Carbon::parse(Session::get('calendar')['term_begins']);
        $ends = Carbon::parse(Session::get('calendar')['term_ends']);
        $days = $start->diffInDaysFiltered(function(Carbon $date){
            return !$date->isWeekend();
        },$ends); 
        return $days+1; 
    }
    
    function weeks_in_term(){
        $start = Carbon::parse(Session::get('calendar')['term_begins']);
        $ends = Carbon::parse(Session::get('calendar')['term_ends']); 
        $weeks = $start->diffInWeeks($ends)+1; 
        return $weeks; 
    }
    ##     9121151372

    function weeks_spent_in_term(){
        $start = Carbon::parse(Session::get('calendar')['term_begins']);
        $ends = Carbon::now(); ## parse(Session::get('calendar')['term_ends']); 
        $weeks = $start->diffInWeeks($ends); 
        return $weeks+1;  
    }
   
    function weekDays($start = "2024-1-20", $end = "2024-2-14"){
        $x = Carbon::parse($start); $y = Carbon::parse($end); 
        for($d = $x; $d->lte($y); $d->addDay()){
            echo "$d ".$d->dayName." - is weekend = ". $d->isWeekend(); 
            echo "<br/>";
        }        
    }
        
    function workingDays($start = "", $end = ""){
        $pre_start = empty($start)?Session::get('calendar')['term_begins']:$start; 
        $pre_end =  empty($end)?Session::get('calendar')['term_ends']:$end; 
        $x = Carbon::parse($pre_start); $y = Carbon::parse($pre_end); 
        $days = []; 
        for($d = $x; $d->lte($y); $d->addDay()){
            if(!$d->isWeekend()):
                $days[]=$d->toDateString();
            endif;
        }        
        return $days; 
    }
//    function nth($number){  
//        ## $nth =  new NumberFormatter('en_US', NumberFormatter::ORDINAL); 
//       ## return $nth->format($number);
//    }

function timeSchedule($hours,$minutes, $force_show = false){
   $h = addS("Hour", $hours);
   $m = addS("Minute", $minutes);
   
   return $h." ".$m; 
}

function addS($text,$number,$force_show = false){
    $rs ="";    ## result
    if($number == 0 ){
        $rs =  "";
    }
    if($number ==1 ){
        $rs = $number." ".$text;
    }    
    if($number >=2 ){
        $rs =  $number." ".$text."s";
    }
    return $rs; 
}

function saveAnswersAndGetScore(){
    $totQtn = count(Session::get('questions')) ?? 0; 
     // mark the question 
     #################################   
    $marks = []; 
    for($k = 0; $k<$totQtn; $k++){
        $correct = '0'; 
        if(!is_null(Session::get('ans-'.$k))){
        $ans = Session::get('ans-'.$k);    
        $option_id = explode("|", $ans)[0];
        $correct = explode("|", $ans)[1];        
        ## save the answers 
         
        $answer = Answer::firstOrNew(['option_id'=>$option_id,'user_id'=>Auth::user()->id]); ## ::create(['option_id'=>$option_id,'user_id'=>Auth::user()->id]);
            $answer->option_id = $option_id;
            $answer->user_id = Auth::user()->id;
            $answer->save(); 
        }
        $marks[] = $correct; 
    } 
    return [array_sum($marks),$totQtn]; 
}

 function users_name($user_id){
    $user = User::find($user_id);
    return $user->surname.',  '.$user->firstname.' '.$user->othername; 
}

  function adminRoles($id, $toString = true){
        $admin = Admin::find($id);
        $my_roles = $admin->getRoleNames()->toArray();           
        return  ($toString) ? implode(" , ", $my_roles) : $my_roles;
    }
    # 
      function admin_info($admin_id){
		$user = Admin::find($admin_id);   
		return ['fullname'=>$user->title.' '.$user->surname.',  '.$user->firstname.' '.$user->othername,
		   'mobile'=>$user->mobile,'email'=>$user->email,'regno'=>$user->regno];     
	}
       
    function check_subject_levels($subject_id,$def_courses,$level_ids){
        if(array_key_exists($subject_id, $def_courses)){            
        $defined = explode(',', $def_courses[$subject_id]); 
        $searching = $level_ids; 
        $matched = array_intersect($searching,$defined);
        
        $valid = ($searching == $matched)?'1':'0'; 
        
        ## return Arr::join($searching,'+')." | ".Arr::join($matched,'+')." | ".$def_courses[$subject_id]." | ".$valid; #  $def_courses[$subject_id];
        return $valid;
        }
    }
    
     function get_new_user_id(){       
        $total = User::count(); 
        $next = $total + 1; 
        $padded = Str::padLeft($next, 4, '0');        
        return "HIPBS".$padded ;
    }
    
    function count_total_students(){       
        $total = User::count();               
        return $total; 
    }
    
    function count_total_admins(){       
        $total = Admin::count();               
        return $total; 
    }
    
    function count_total_subjects(){       
        $total = Subject::count();               
        return $total; 
    }
    
    function count_total_classrooms(){       
        $total = ClassRoom::count();               
        return $total; 
    }
          
    function get_student_position($id, $array_results,$max_score = 100){        
        $results = collect($array_results); 
        $results_sorted = $results->sort()->reverse();
        $current_rank = 1; $number_in_position = 0; 
        $current_score = $max_score; 
        foreach($results_sorted as $pin => $result):
            if($result < $current_score ){ 
                $current_score = $result; 
                $current_rank += $number_in_position; 
                $number_in_position = 1; 
                $output[$pin] = [$current_rank, $result];
                }
                else{ //same score as the previous
                    $number_in_position++; 
                    $output[$pin] = [$current_rank, $result];                     
                } 
              endforeach; 
            return ordinal($output[$id][0],true);                
    }
   
    
    
    function handle() { 
       $marks = collect([3101625668 => 98.0,
           3101635921 => 98.0, 3913126364 => 35.77, 
           3913058204 => 25.33, 3101372540 => 33.47,
           3913752741 => 40.0, 3913120054 => 20.4, 
           3913998755 => 26.67, 3913861492 => 25.2, 
           3913881854 => 19.8,]); 
       $avg = $marks->avg(); $rank = 0; $run = 0; 
       $prev = null; 
       $marks->sort() ->reverse()->map(
               function ($mark, $id) use ($avg, &$rank, &$run, &$prev) { 
                $run = $mark == $prev ? $run + 1 : 0; $prev = $mark; 
               
                return [ 'mark' => $mark, 'rank' => ++$rank - $run, 
               'dev' => $mark - $avg, 'id' => $id, ]; 
               
               })
               ->dump();
        }

    function ordinal($number,$sup = false){

        $suffix = '';
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = 'th';
        } else {
            switch ($number % 10) {
                case 1: $suffix = 'st'; break;
                case 2:$suffix = 'nd'; break;
                case 3:$suffix = 'rd'; break;
                default:$suffix = 'th'; break;
            }
        }
        $pre_suffix = ($sup)?"<sup>".$suffix."</sup>" : $suffix; 
        return $number . $pre_suffix;
    }
    
  ## 8113355305