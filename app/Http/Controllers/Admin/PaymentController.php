<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\PaymentItem;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use function redirect;
use function response;
use function view;


class PaymentController extends Controller
{
    public function payment_items(Request $request, $id=null) {
       Session::put('page','finance_management'); Session::put('subpage','payment_items');       
       $page_info = ['title'=>'Add New Payment Item ','icon'=>'pe-7s-cash','sub-title'=>''];
       
        if($id==''){
//           $page_info = ['title'=>'Add New Payment Type ','icon'=>'pe-7s-cash','sub-title'=>'Below are the list of Payment Types'];      
             $payItem = new PaymentItem(); $message = "New Payment Item Successfully Saved"; 
       }
       else {
           $page_info = ['title'=>'Update Payment Item ','icon'=>'pe-7s-cash','sub-title'=>'Below are the list of Payment Items'];      
           $payItem = PaymentItem::find($id); $message = " Payment Item Successfully Updated"; 
       }
       
        if($request->isMethod('post')){
           $data = $request->all(); ## print "<pre>"; print_r($data);  die;
            $rules = [
                'item_name'=>"required|string|unique:payment_items,name,".$payItem->id                
            ];
            $customMessage = [
               'item_name.required'=>"Please fill in the Item name", 
               'item_name.unique'=>"This Payment Item [ ' {$data['item_name']}' ] Already Exists"              
                ];
             ##$validator = Validator::make($data, $rules,$customMessage);
            
            $this->validate($request, $rules, $customMessage); 
            
            $payItem->name = $data['item_name'];            
            $payItem->status = 1;          
            $payItem->save(); 

            return redirect('admin/payment-items')->with('success_message',$message);
            // return response()->json(['type'=>'success','success_message'=>$message,'url'=>'subjects']);          
       } 
       
        $all_pay_items = PaymentItem::orderBy('name')->get(); 
        return view('admin.payments.setups.payment_items',compact('page_info','all_pay_items','payItem'));
    }
    public function setup_payment_types(Request $request, $id=null) {
       Session::put('page','finance_management'); Session::put('subpage','payment_setups');       
       $page_info = ['title'=>'Add New Payment Type ','icon'=>'pe-7s-cash','sub-title'=>''];
       
        if($id==''){
//           $page_info = ['title'=>'Add New Payment Type ','icon'=>'pe-7s-cash','sub-title'=>'Below are the list of Payment Types'];      
             $payType = new PaymentType(); $message = "New Payment Types Successfully Saved"; 
       }
       else {
           $page_info = ['title'=>'Update Payment Types ','icon'=>'pe-7s-cash','sub-title'=>'Below are the list of Payment Types'];      
           $payType = PaymentType::find($id); $message = " Payment Types Successfully Updated"; 
       }
       
        if($request->isMethod('post')){
           $data = $request->all(); ## print "<pre>"; print_r($data);  die;
            $rules = [
                'payment_name'=>"required|string|unique:payment_types,name,".$payType->id,
                'payment_code'=>"required|string|unique:payment_types,code,".$payType->id
            ];
            $customMessage = [
               'payment_name.required'=>"Please fill in the payment name", 
               'payment_name.unique'=>"This Payment Name [ ' {$data['payment_name']}' ] Already Exists", 
               'payment_code.unique'=>"This Payment Code [ ' {$data['payment_code']}' ] Already Exists"
                ];
             ##$validator = Validator::make($data, $rules,$customMessage);
            
            $this->validate($request, $rules, $customMessage); 
            
            $payType->name = $data['payment_name'];
            $payType->code = $data['payment_code'];
            $payType->status = 1;          
            $payType->save(); 

            return redirect('admin/setup-payment-types')->with('success_message',$message);
            // return response()->json(['type'=>'success','success_message'=>$message,'url'=>'subjects']);          
       } 
       
        $all_pay_types = PaymentType::orderBy('name')->get(); 
        return view('admin.payments.setups.index',compact('page_info','all_pay_types','payType'));
    }
    
    //
    public function payment_amounts_setup(Request $request, $param="") {
        Session::put('page','finance_management'); Session::put('subpage','payment_amounts_setup');       
        $page_info = ['title'=>'Setup Payment Amounts Per Payment Types','icon'=>'pe-7s-cash','sub-title'=>'Select Payment Type from the list below and click go'];
        
        $sessions = range(date('Y'), 2022);
        $all_pay_types = PaymentType::where('status',1)->orderBy('name')->get(); 
        # Session::put('continue', false); 
        $levels = Level::all();
        # dd($levels);       
       
       return view('admin.payments.setups.amount_setup',compact('page_info','all_pay_types','sessions','levels'));            
    }
 
    public function search_payment_amount_setup(Request $request) {
         if($request->isMethod('post')):
          $data = $request->all();        
          $rules = [  'session'=>'required','payment_type'=>'required','level'=>'required']; 
          $msg = ['payment_type.required'=>'Select Payment Type','session.required'=>'Select Session','level.required'=>'Select Academic Level']; 
        
          # $validator = $this->validate($request, $rules,$msg);
           $validator = Validator::make($data, $rules,$msg);
          if($validator->fails()):
              return response()->json([
                  'status'=>'error','message'=>$validator->messages()
              ]);
              else :
              $paymentItems = PaymentItem::where(['status'=>1])->orderBy('name')->get();
              // $paymentItems;
              
               return response()->json([
                  'status'=>'success',
                  'view'=>(String)View::make('admin.payments.setups.payment_amount_setup_ajax')->with(compact('data','paymentItems'))
              ]);
          endif;
              
          
         
          Session::put('payment_type',$data['payment_type']);
          Session::put('payment_session',$data['session']); 
          Session::put('payment_level',$data['level']); 
          Session::put('continue', true); 
        endif; 
        
//        if(Session::get('continue')):
//         return view('admin.payments.setups.amount_setup',compact('page_info','all_pay_types','sessions','levels'));            
//        endif;
         
        # return response()
    }
    
    public function payment_item_status_update(Request $request) {
         if($request->ajax()){
            $data = $request->all(); $respStatus = "1";            
            if($data['status']=="active") :  $respStatus = "0";  endif;            
            PaymentItem::where('id',$data['data_id'])->update(['status'=>$respStatus]);            
            return response()->json(['status'=>$respStatus]);
        }
    }
    public function payment_type_status_update(Request $request) {
         if($request->ajax()){
            $data = $request->all(); $respStatus = "1";            
            if($data['status']=="active") :  $respStatus = "0";  endif;            
            PaymentType::where('id',$data['data_id'])->update(['status'=>$respStatus]);            
            return response()->json(['status'=>$respStatus]);
        }
    }
}
