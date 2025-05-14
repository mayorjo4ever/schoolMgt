<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersResult extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','regno'];
    
    public static function subject_group_results($session, $term, $class_room_id, $subject_id){
        $output = []; 
        $results = UsersResult::select('regno','ca_1','ca_2','exam')
          ->where([
            'session'=>$session,
            'term'=>$term,
            'class_room_id'=>$class_room_id,
            'subject_id'=>$subject_id
        ])->get()->toArray();
        
        if(!empty($results)):
            foreach ($results as $result):
               $total = $result['ca_1']+$result['ca_2']+$result['exam'];
               $output[$result['regno']] = $total;            
            endforeach;
        endif;        
        
        return $output; 
    }
    
    public static function class_group_result($session, $term, $class_room_id ) {
        $output = []; 
        $results = self::where('session','=',$session)
            ->where('term','=',$term)
            ->where('class_room_id','=',$class_room_id)
            ->select('regno', \DB::raw('SUM(ca_1) as sum_ca1'), 
             \DB::raw('SUM(ca_2) as sum_ca2'),
             \DB::raw('SUM(exam) as sum_exam'))           
            ->groupBy('regno')
            ->get()->toArray();  ##; 
            ####
        if(!empty($results)):
            foreach ($results as $result):
               $total = $result['sum_ca1']+$result['sum_ca2']+$result['sum_exam'];
               $output[$result['regno']] = $total;            
            endforeach;
        endif;    
        
        return $output;
        
    }
    
}
