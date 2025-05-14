<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ResultImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class UploadManager extends Controller
{
    //read imported result 
    public function read_excel_result(Request $request) {
        
        $data = $request->all(); #  print "<pre>"; print_r($data); die; 
        
        $rules = ['file'=>'required|mimes:csv']; ## others : jpg,jpeg,png,webp
                $customMessage = ['file.mimes'=>'Only CSV File is allowed',
                    'file.required'=>'You must attach csv file'];
        $this->validate($request, $rules, $customMessage); //        
        
        ## process upload 
        Session::put('acad_session',$data['session']);
        Session::put('term',$data['term']);
        Session::put('class-room',$data['class-room']);
        Session::put('subject_id',$data['subject_id']);
        
        Excel::import(new ResultImport,$data['file']);
      
        return redirect('admin/student-result/upload-success');
    }
    
    public function upload_success_message_view() {
      
        $page_info = ['title'=>'Result Upload Message','icon'=>'pe-7s-note','sub-title'=>''];
        
        return view('admin.staff.students.bulk_result_upload_success', compact('page_info'));
        
    }
    
    
}
