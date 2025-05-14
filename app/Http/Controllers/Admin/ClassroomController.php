<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function redirect;
use function view;

class ClassroomController extends Controller
{
    public function classrooms() {
        Session::put('page','acad-settings'); Session::put('subpage','classrooms');
        $page_info = ['title'=>'Academic Class Rooms ','icon'=>'pe-7s-graph2','sub-title'=>'Student Lecture Rooms'];
        $btns = [['name'=>"Create New Classroom",'action'=>"admin/add-edit-classroom", 'class'=>'btn btn-success']];
        $classrooms = ClassRoom::all();                 
        $levels = Level::all()->pluck('name','id');
        # dd($levels);
        return view('admin.classrooms.classrooms')->with(compact('page_info','classrooms','levels','btns'));
    }
    
     public function addEditClassRoom(Request $request, $id=null) {
        Session::put('page','acad-settings'); Session::put('subpage','add-classroom');
        $page_info = ['title'=>'Create New Class Room ','icon'=>'pe-7s-graph1','sub-title'=>'Create or make corrections to your classroom'];
        $btns = [['name'=>"View Class Rooms",'action'=>"admin/classrooms", 'class'=>'btn btn-dark']];
      
        if($id == ""){
            $classroom = new ClassRoom;  $message = "ClassRoom Created Successfully";
        }
        else {
            $page_info['title'] = "Edit Class Room"; 
            $classroom = ClassRoom::find($id); $message = "ClassRoom Updated Successfully";
        }
		## print $classroom['id']; die; 
        ## when submitting 
        if($request->isMethod('post')){
            $data = $request->all();
            $classroom->name = $data['name'];           
            $classroom->level_id = $data['level'];           
            $classroom->capacity = $data['capacity'];           
            $classroom->save();
            return redirect('admin/classrooms')->with('success_message',$message);
        }
		
        $levels = Level::all()->toArray(); 
        return view('admin.classrooms.add_edit_classroom', compact('classroom','levels','btns','page_info')); 
    }
   
   
}
