<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function greetings;
use function view;

class StudentController extends Controller
{
    public function dashboard() {
        $id = Auth::guard('student')->user()->id; 
        $me = User::where('id',$id)->first(); 
        Session::put('page','dashboard'); Session::put('subpage','dashboard');       
        $page_info = ['title'=>greetings().$me['name'],'icon'=>'pe-7s-home','sub-title'=>'Education is the best legacy'];
         
        return view('front.dashboard',compact('page_info','me'));       
    }
    
    public function profile() {
       ## $id = Auth::id(); 
        $id = Auth::guard('student')->user()->id; 
        $me = User::where('id',$id)->first(); 
        Session::put('page','dashboard'); Session::put('subpage','profile');       
        $page_info = ['title'=>'My Profile','icon'=>'pe-7s-user','sub-title'=>''];
        $btns = [
           ['name'=>"<-- Back ",'action'=>"student/dashboard", 'class'=>'btn btn-primary'],
           ]; 
        
       return view('front.profile.profile',compact('page_info','me','btns'));       
    }
    
    public function view_courses($level = null){
        
    }
}
