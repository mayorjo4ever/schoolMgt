<?php

namespace App\Exports; 

use App\Models\UsersRegisteredCourses;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ImportResultTemplate implements FromView ## FromQuery  ## FromCollection
{
    /**
    * @return Collection
    */
    
    use Exportable;
   
    public function __construct($session, $classroom,$subject)
    {
        $this->session = $session;       
        $this->class_room_id = $classroom;
        $this->subject = $subject;
    }
   
   /**
   public function query()
    {
        return UsersRegisteredCourses::query()->where('session',$this->session)
             ->where('class_room_id',$this->class_room_id);
    }
    **/
    
    public function view(): View
    {
        $students = UsersRegisteredCourses::where('session',$this->session)
             ->where('class_room_id',$this->class_room_id)->get();
        
        return view('exports.result_import', [
            'students' => $students,'subject'=>$this->subject
        ]);
    }
    
    /**
    public function collection()
    {
        return UsersRegisteredCourses::all();
    }
   
    public function header(){
        
    }
     *      */
}
