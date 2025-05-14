<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function redirect;
use function response;
use function view;

class RoleController extends Controller
{
    public function __construct() {
        ## $this->middleware(['role_or_permission:Super-Admin|view-role|edit-role']);
        ## or
        ## $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    }
            
            
    public function viewRoles(){
         ## $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
        Session::put('page','role_perm'); Session::put('subpage','roles');
        $page_info = ['title'=>'All Roles ','icon'=>'pe-7s-wristwatch','sub-title'=>'Below are all available roles'];
        $btns = [['name'=>"Create New Role",'action'=>"admin/add-edit-role", 'class'=>'btn btn-success']];
      
        $roles = Role::all()->toArray();
         ##  print "<pre>";  print_r($roles); die;         
         ## $user = [4, 2, 1, 3, 5];
         ## array_flip($user);
         ## dd($user);
        
        return view('admin.roles.roles', compact('roles','btns','page_info')); 
        
    }
    
    public function addEditRole(Request $request, $id=null) {
         Session::put('page','role_perm'); Session::put('subpage','add_role');
        $page_info = ['title'=>'Add New Role ','icon'=>'pe-7s-wristwatch','sub-title'=>'Below are all available roles'];
        $btns = [['name'=>"View Role",'action'=>"admin/roles", 'class'=>'btn btn-dark']];
      
        if($id == ""){
            $role = new Role;  $message = "Role Created Successfully";
        }
        else {
            $page_info['title'] = "Edit Role"; 
            $role = Role::find($id); $message = "Role Updated Successfully";
        }
        
        ## when submitting 
        if($request->isMethod('post')){
            $data = $request->all();
            $role->name = $data['name'];
            $role->guard_name = $data['guard'];
            $role->save();
            return redirect('admin/roles')->with('success_message',$message);
        }
        return view('admin.roles.add_edit_role', compact('role','btns','page_info')); 
    }
    
    
   public function addEditPermission(Request $request, $id=null) {
        Session::put('page','role_perm'); Session::put('subpage','add_permission');
        $page_info = ['title'=>'Add New Permission ','icon'=>'pe-7s-wristwatch','sub-title'=>'Below are all available roles'];
        $btns = [['name'=>"View Permission",'action'=>"admin/permissions", 'class'=>'btn btn-dark']];
      
        if($id == ""){
            $permission = new Permission;  $message = "Permission Created Successfully";
        }
        else {
            $page_info['title'] = "Edit Permission"; 
            $permission = Permission::find($id); $message = "Permission Updated Successfully";
        }
        $categories = ['admins','payments','roles','students','subjects','settings']; 
        ## when submitting 
        if($request->isMethod('post')){
            $data = $request->all();
            $permission->name = $data['name'];
            $permission->category = $data['category'];
            $permission->guard_name = $data['guard'];
            $permission->save();
            return redirect('admin/permissions')->with('success_message',$message);
        }
        return view('admin.roles.add_edit_permission', compact('permission','btns','page_info','categories')); 
    }
    
     public function viewPermissions(){
        Session::put('page','role_perm'); Session::put('subpage','permissions');
        $page_info = ['title'=>'All Permissions ','icon'=>'pe-7s-wristwatch','sub-title'=>'Below are all available permissions'];
        $btns = [['name'=>"Create New Permission",'action'=>"admin/add-edit-permission", 'class'=>'btn btn-success']];
      
        $permissions = Permission::all()->toArray();
         ##  print "<pre>";  print_r($roles); die; 
        return view('admin.roles.permissions', compact('permissions','btns','page_info')); 
        
    }
    
    public function rolesPermission() {
        Session::put('page','role_perm'); Session::put('subpage','assign_role_perm');
        $page_info = ['title'=>"Role's Permission Setup ",'icon'=>'pe-7s-wristwatch','sub-title'=>'Below are all available permissions'];
        $btns = [['name'=>"View Permission",'action'=>"admin/permissions", 'class'=>'btn btn-dark']];
        $roles = Role::all()->toArray(); 
        return view('admin.roles.role_permission', compact('btns','page_info','roles')); 
      
    }
    
   public function loadPermissions(Request $request) {
        if($request->ajax()){
            $data = $request->only('role_id');  $role_id = $data['role_id'];
            $perms = Permission::OrderBy('category')->get(); # ->toArray()
            $groupPerms = $perms->groupBy('category')->toArray();
            $assigned_perms = Role::findById($role_id)->permissions()->get()->pluck('id')->toArray();
            
            //print "<pre>";
            //print_r($groupPerms); die; 
            return response()->json([
                'view'=>(String)View::make('admin.roles.role_perm_ajax')->with(compact('groupPerms','assigned_perms','role_id'))
            ]);
        } 
    } ## 
     public function changeRolePermission(Request $request) {
        if($request->ajax()){
            $data = $request->all();
            
            $role = Role::findById($data['role_id']);
            $permission = Permission::findById($data['perm']); 
            
            if($data['status']=="active"){
                $message = "Permission Assigned Successfully";
                $role->givePermissionTo($permission);
            }
            else {
                $message = "Permission Removed Successfully";
                $role->revokePermissionTo($permission);
            }
             return response()->json([
                'message'=>$message        
            ]);
        }
        
     }
    
}
