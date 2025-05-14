<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportAdmins;
use App\Models\Admin;
use App\Models\AdminClassGroups;
use App\Models\AdminSubjects;
use App\Models\ClassRoom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use function admin_info;
use function asset;
use function greetings;
use function redirect;
use function response;
use function url;
use function view;

class AdminController extends Controller
{
    public function __construct() {
        # $this->middleware(['permission:view-admin','permission:create-admin']);
         ##if(Auth::guard('admin')->check()){
         ##   $this->middleware(['permission:view-admin']);
        ## }
    }
     public function dashboard() {
       Session::put('page','dashboard'); Session::put('subpage','dashboard');
       #$page_info = ['title'=>'Welcome,  '.Auth::guard('admin')->user()->name,'icon'=>'pe-7s-home','sub-title'=>'Education is the best legacy'];
       $page_info = ['title'=> greetings().' '. admin_info(Auth::guard('admin')->user()->id)['fullname'],'icon'=>'pe-7s-home','sub-title'=>'Education is the best legacy'];

     $perms = Permission::all(); // ->pluck('id')->toArray()
     $roles = Role::all()->toArray();
     $superAdmin = Role::find(1);
     $admin = Admin::find(1);
     // echo  $admin->assignRole('Super-Admin'); 
     // $superAdmin->syncPermissions($perms);
      // print "<pre>";
     //echo $superAdmin->givePermissionTo(1);
      // print_r($perms); die; 

      return view('admin.dashboard',compact('page_info'));
    }


    public function updateAdminPassword(Request $requst) {
          Session::put('page','update_password'); Session::put('subpage','update_password');
          $page_info = ['title'=>'Manage Password','icon'=>'pe-7s-user','sub-title'=>'When you noticed vunerability, please always change your password, and subsequently every 3 months '];
        if($requst->isMethod('post')){
            $data = $requst->all(); // print "<pre>";
            // var_dump($data); die;
             if(!Hash::check($data['current_password'], Auth::guard('admin')->user()->password))
             {
                 return redirect()->back()->with('error_message','Your current password is incorrect');
             }
             else {
                 if($data['confirm_password'] == $data['new_password']){
                      Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>Hash::make($data['new_password'])]);
                      Auth::guard('admin')->logoutOtherDevices($current_psw);
                    return redirect()->back()->with('success_message','Your password has been updated');
                 }
                 else {
                     return redirect()->back()->with('error_message','New password and Confirm password does not match');
                 }
             }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails','page_info'));
    }

     public function checkAdminPassword(Request $request) {
       $data = $request->all();
       if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
           return "true";  } else { return "false"; }
    }

    public function admins(){
       Session::put('page','admin_mgt'); Session::put('subpage','admin-staff');
       $page_info = ['title'=>'Administrative Staff','icon'=>'pe-7s-users','sub-title'=>'List of Administrative Staff'];
       $btns = [
            ['name'=>"Add New Staff",'action'=>"admin/add-edit-staff", 'class'=>'btn btn-success'],
            ['name'=>"Import More Staff",'action'=>"admin/staff/import", 'class'=>'btn btn-dark']
            ];
       $admins = Admin::get()->toArray();
       return view('admin.staff.staff',compact('page_info','admins','btns'));
    }

    public function adminImportView() {
        Session::put('page','admin_mgt'); Session::put('subpage','import-staff');
        $page_info = ['title'=>'Import New Staff ','icon'=>'pe-7s-user','sub-title'=>'Importing Staff with ease '];
        $btns = [
            ['name'=>"Add New Staff",'action'=>"admin/add-edit-staff", 'class'=>'btn btn-success'],
            ['name'=>"View Staff",'action'=>"admin/staff", 'class'=>'btn btn-dark'],
            ['name'=>"Download Sample",'action'=>"admin/staff", 'class'=>'btn btn-info']
            ];
       # dd($subjects);
        return view('admin.staff.import_staff',compact('page_info','btns'));
    }

    public function readExcel(Request $request) {
      $data = $request->all();
      Excel::import(new ImportAdmins(), $data['file']);
      ## return redirect()->back()->with('success_message','Students successfully uploaded');
        return redirect('admin/staff')->with('success_message','Staff Successfully Uploaded');
    }
    ###################################


    public function addEditAdmin(Request $request, $id=null){
       Session::put('page','admin_mgt'); Session::put('subpage','add-staff');
       $page_info = ['title'=>'Add New Administrative Staff','icon'=>'pe-7s-users','sub-title'=>'Enroll New Administrative Staff, all other details whill be processed by themselves'];
       $btns = [
           ['name'=>"Import More Staff",'action'=>"admin/staff/import", 'class'=>'btn btn-success'],
           ['name'=>"View Staff",'action'=>"admin/staff", 'class'=>'btn btn-dark'],
          ];
        $disable_edit = "";## enabled

       $all_roles = Role::all();
       $all_subjects = Subject::all()->toArray();
       $all_classrooms = ClassRoom::all();

       $my_roles = []; $my_subjects = []; $my_classrooms = [];

       if($id==""){
           $admin = new Admin; $message = "Admin Profile Successfully Saved";
       }
       else {
           $admin = Admin::with('mysubjects','myclassgroups')->find($id); $message = "Admin Profile Successfully Updated";
           $page_info['title'] = "Update Administrative Staff Info";
           $my_roles = $admin->getRoleNames()->toArray();
           $pre_subjects = $admin->mysubjects;
           $pre_classrooms = $admin->myclassgroups;
           if(!empty($pre_subjects)) { $my_subjects = explode(",",$pre_subjects['subject_ids']); }
           if(!empty($pre_classrooms)){ $my_classrooms = explode(",",$pre_classrooms['classroom_ids']); }
       }
        # print "<pre>";
        # print_r($my_subjects);
        # print_r($my_classrooms);         die;

       ## updating admin info
       if($request->isMethod('post')){
           $data = $request->all(); ## print "<pre>";  print_r($data);   die;

           $admin->title = $data['title'];
           $admin->surname = $data['surname'];
           $admin->firstname = $data['firstname'];
           $admin->othername = $data['othername'];
           $admin->email = $data['email'];
           $admin->regno = $data['regno'];
           $admin->mobile = $data['mobile'];
           ### for new admin registration
           #####################################
           if($id=="" && $data['password']=="")
            { $admin->password = Hash::make(strtolower($data['surname']));  }
            ######## reset staff password
            if(isset($data['reset_password'])){
             $admin->password = Hash::make($data['password']);
             }
             ## updating passport
             if(Session::get('current_staff_psp')):
             $admin->pix = $this->savePix($admin->regno);
            endif;

           $admin->save();

           ## update admin's major subjects
           if(!empty($data['my-subjects'])):
               $adminSubjects = AdminSubjects::firstOrNew(['admin_id'=>$admin->id]);
               $adminSubjects->admin_id = $admin->id;
               $adminSubjects->subject_ids = implode(',',$data['my-subjects']);
               $adminSubjects->save();
            endif ;
           ## update admin's classrooms for teaching
           if(!empty($data['my-class-groups'])):
               $adminClassGroup = AdminClassGroups::firstOrNew(['admin_id'=>$admin->id]);
               $adminClassGroup->admin_id = $admin->id;
               $adminClassGroup->classroom_ids = implode(',',$data['my-class-groups']);
               $adminClassGroup->save();
             endif ;

             if(!empty($data['my-roles'])):
                 $admin->syncRoles($data['my-roles']);
            endif ;

             $this->clearpix();

           return redirect('admin/staff')->with('success_message',$message);
       }
       // $admin->assignRole([]);
       return view('admin.staff.add_edit_staff',compact('page_info','admin','disable_edit','btns','all_roles','my_roles','all_subjects','my_subjects','all_classrooms','my_classrooms'));
    }
   ### uploading staff passport

    public function upload_passport(Request $request) {
       if($request->ajax()):
              $rules = ['picture'=>'mimes:jpg,jpeg,png'];
                $customMessage = ['picture.mimes'=>'Only Image File of type jpg, jpeg and png is allowed'];
                $this->validate($request, $rules, $customMessage); //

               $image_tmp = $request->file('picture');
                if($image_tmp->isValid()):
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand().uniqid().'.'.$extension;
                    $smallImagePath = "images/staff/temp/".$imageName;
                    $watermark = "images/bg.png";
                   Session::put('current_staff_psp',$imageName);
                   Session::push('staff_temp_psp', $imageName);
                    // create new manager instance with desired driver
                    $manager = ImageManager::gd();
                        $image = $manager->read($image_tmp);
                        $image->resize(200,200);
                        $image->place($watermark,'bottom-left',20,0,100);
                    $image->save($smallImagePath);

                return response()->json([
                   'type'=>'success',
                   'message'=>'Upload Successful',
                   'path'=>asset($smallImagePath)
               ]);
                endif; ## end if valid

       endif; ## end ajax

    }
      protected function savePix($regno) {
        $name = str_replace("/", "", $regno).".png";
         if(Session::get('current_staff_psp')):
             $manager = ImageManager::gd();
             $image = $manager->read("images/staff/temp/".Session::get('current_staff_psp'));
             $newPath = "images/staff/passports/".$name;
             $image->save($newPath);
             return $name;
         endif;
        return "";
    }

    protected function clearpix(){
        if(Session::get('current_staff_psp')):
            foreach(Session::get('staff_temp_psp') as $filename):
                unlink("images/staff/temp/".$filename);
            endforeach;
            Session::forget('staff_temp_psp');
            Session::forget('current_staff_psp');
        endif;
    }
   #
    ## display admin profile
    ### adminProfile
    ## public function adminProfile($id=null) {
    public function adminProfile() {
        $id = Auth::guard('admin')->user()->id;
         Session::put('page','my_profile'); Session::put('subpage','my_profile');
         $page_info = ['title'=>'My Personal Profile','icon'=>'pe-7s-user','sub-title'=>'Below are the details about you'];
         $btns = [
           ['name'=>"Manage Password",'action'=>"admin/manage-password", 'class'=>'btn btn-dark'],
           ['name'=>"Dashboard",'action'=>"admin/dashboard", 'class'=>'btn btn-info'],
          ];
         $disable_edit = "disabled";

        $all_roles = Role::all();   $my_roles = []; $my_subjects = []; $my_classrooms = [];
        $all_subjects = Subject::all()->toArray();
        $all_classrooms = ClassRoom::all();

         if($id!=""){
          $admin = Admin::with('mysubjects','myclassgroups')->find($id);
          $my_roles = $admin->getRoleNames()->toArray();
           $pre_subjects = $admin->mysubjects;
           $pre_classrooms = $admin->myclassgroups;
           if(!empty($pre_subjects)) { $my_subjects = explode(",",$pre_subjects['subject_ids']); }
           if(!empty($pre_classrooms)){ $my_classrooms = explode(",",$pre_classrooms['classroom_ids']); }
          return view("admin.staff.my_profile",compact('page_info','admin','btns','disable_edit','all_classrooms','all_subjects','all_roles','my_roles','my_subjects','my_classrooms'));
         }
    }

    ## assign role to admin
    public function assignRole($staff_id=null) { ## page view for assigning role
        Session::put('page','admin_mgt'); Session::put('subpage','assign_role');
        $page_info = ['title'=>'Assign Role For Staff','icon'=>'pe-7s-users','sub-title'=>'Specify which role a staff is allowed to have '];
        $btns = [
            ['name'=>"View Roles",'action'=>"admin/roles", 'class'=>'btn btn-dark'],
            ['name'=>"View Permissions",'action'=>"admin/permissions", 'class'=>'btn btn-success'],
            ['name'=>"View Staff",'action'=>"admin/staff", 'class'=>'btn btn-info'],
           ];
        $admins = Admin::get()->toArray();
        $roles = Role::all()->toArray();
        return view('admin.staff.staff_role', compact('page_info','btns','admins','roles','staff_id'));
    }
   ##
   public function getAdminRoles(Request $request) {
       if($request->ajax()){
          $data = $request->all();  $admin_id = $data['admin_id'];
          ##$all_roles = Role::all()->pluck('name','id');
          $all_roles = Role::all();
          $admin = Admin::find($admin_id);
          $my_roles = $admin->getRoleNames()->toArray();
          ##$assignedRoles = Admin::with('roles')->get()->toArray();
          ## $perms = $admin->getPermissionNames();
          ## $perms = $admin->getAllPermissions();
          ## $perms = $admin->getPermissionsViaRoles()->pluck('name');
          #print "<pre>";
          #print_r($all_roles);
          # print_r($my_roles);
          # exit;
          /** TO ASSIGN  : USE
           * All current roles will be removed from the user and replaced by the array given
           * $user->syncRoles(['writer', 'admin']);
          */

         return response()->json([
                'view'=>(String)View::make('admin.roles.role_list_ajax')->with(compact('all_roles','my_roles'))
            ]);
       } ## end if
   } ## end function

    public function setAdminRoles(Request $request) {
       if($request->ajax()){
          $data = $request->all();  // $admin_id = $data['admin_id'];
          $admin_id = $data['admin-staff'];
          $roles = $data['your_roles'];
          $admin = Admin::find($admin_id);
          //dd($roles);
           $admin->syncRoles($roles); # remove every existing roles and assign the newly selected roles

          return response()->json([
              'status'=>'success',
              'message'=>'Roles successfully asigned for this Admin'
          ]);

       }
     }

     public function manage_password(Request $request){
        Session::put('page','psw_mgt'); Session::put('subpage','psw_mgt');
        $page_info = ['title'=>'Reset Password  ','icon'=>'pe-7s-lock','sub-title'=>'It is recommended to always change password ones in every 3 months'];
        $btns = [
            ['name'=>"View My Profile",'action'=>"admin/my-profile", 'class'=>'btn btn-success'],
            ['name'=>"Dashboard",'action'=>"admin/dashboard", 'class'=>'btn btn-info'],
           ];
        if($request->isMethod('post')){
            $data = $request->all();
             if(!Hash::check($data['current_password'], Auth::guard('admin')->user()->password))
             {
                return response()->json([
                   'message' =>'Your current password is incorrect','status'=>'error'
                ]);
                 ## return redirect()->back()->with('error_message','Your current password is incorrect');
             }
             else if(Hash::check($data['new_password'], Auth::guard('admin')->user()->password))
             {
                return response()->json([
                   'message' =>'You cannot use old password again, try another one ','status'=>'error'
                ]);
                 ## return redirect()->back()->with('error_message','Your current password is incorrect');
             }
             else {
                 if($data['confirm_password'] == $data['new_password']){
                   # Auth::guard('admin')->logoutOtherDevices($data['current_password']);
                     Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=> Hash::make($data['new_password'])]);
                    return response()->json([
                            'message' =>'Password changed successfully, you will need to login again... ','status'=>'success',
                            'dir'=> url('portal/login')
                         ]);
                    ## return redirect()->back()->with('success_message','Your password has been updated');
                 }
                 else {
                      return response()->json([
                            'message' =>'New password and Confirm password does not match','status'=>'error'
                         ]);
                     ##return redirect()->back()->with('error_message','New password and Confirm password does not match');
                 }
             }
            return response()->json($request->all());
        }

        return view('admin.staff.reset_password', compact('page_info','btns'));
     }
}
