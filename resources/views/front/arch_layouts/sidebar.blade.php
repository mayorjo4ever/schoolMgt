<div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
      <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{url('admin/dashboard')}}" @if(Session::get('subpage')=='dashboard')  class="mm-active"  @endif >
                        <i class="metismenu-icon pe-7s-home"></i>
                        Home
                    </a>
                </li>                       
                <li>
                    <a href="{{url('student/profile')}}"  @if(Session::get('subpage')=='profile')  class="mm-active"  @endif >
                        <i class="metismenu-icon pe-7s-user">
                        </i> My Profile
                    </a>
                </li>  
              
              
                <li class="app-sidebar__heading"> Registration / Payment </li>  
                <li>
                    <a href="#" @if(Session::get('page')==="reg_payment") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Courses 
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="reg_payment") class="mm-show" @endif >
                     
                        <li>
                            <a href="{{url('student/course-registration')}}" @if(Session::get('subpage')==="course_reg")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  Course Registration
                            </a>
                        </li>  
                      
                        <li>
                            <a href="{{url('student/print-course-forms')}}"  @if(Session::get('subpage')==="add-staff")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Print Course Forms
                            </a>
                        </li> 
                    </ul>
                    
                    <li>
                    <a href="#" @if(Session::get('page')==="admin_mgt") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-cash"></i>
                        Payments 
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="admin_mgt") class="mm-show" @endif >
                       <li>
                            <a href="{{url('admin/staff/import')}}"  @if(Session::get('subpage')==="import-staff")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i> Make Payments 
                            </a>
                        </li> 
                     
                        <li>
                            <a href="{{url('admin/staff/assign-role')}}" @if(Session::get('subpage')==="assign_role")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  Print My Receipts
                            </a>
                        </li>              
                    </ul>                    
                </li>  
              
                                
                
               @can('view-role')                
                <li>
                    <a href="#" @if(Session::get('page')==="role_perm") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-wristwatch"></i>
                        Roles and Permissions 
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="role_perm") class="mm-show" @endif >
                      @can('view-role')
                        <li>
                            <a href="{{url('admin/roles')}}" @if(Session::get('subpage')==="roles")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  View Roles
                            </a>
                        </li> @endcan 
                        
                        @can('create-role')
                        <li>
                            <a href="{{url('admin/add-edit-role')}}"  @if(Session::get('subpage')==="add_role")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Create New Role
                            </a>
                        </li>  @endcan   
                        
                        @can('view-permission')
                        <li>
                            <a href="{{url('admin/permissions')}}" @if(Session::get('subpage')==="permissions")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  View Permissions
                            </a>
                        </li> @endcan 
                        
                        @can('create-permission')
                        <li>
                            <a href="{{url('admin/add-edit-permission')}}"  @if(Session::get('subpage')==="add_permission")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Create New Permission
                            </a>
                        </li>  @endcan   
                        @can('assign-permission')
                        <li>
                            <a href="{{url('admin/role-permission')}}"  @if(Session::get('subpage')==="assign_role_perm")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i> Role Permission Setup
                            </a>
                        </li>  @endcan   
                           
                    </ul>                    
                </li>  
               @endcan 
               
                 
               @can('view-acad-settings')                
                <li>
                    <a href="#" @if(Session::get('page')==="acad-settings") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-bell"></i>
                        Academic Settings 
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="acad-settings") class="mm-show" @endif >
                      @can('view-session-terms')
                        <li>
                            <a href="{{url('admin/academic-calendar')}}" @if(Session::get('subpage')==="acad-calendar")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                 Academic Calendar
                            </a>
                        </li> @endcan 
                        
                        @can('view-levels')
                        <li>
                            <a href="{{url('admin/acad-levels')}}"  @if(Session::get('subpage')==="acad-levels")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i> Academic Levels
                            </a>
                        </li>  @endcan   
                        
                        @can('view-classroom')
                        <li>
                            <a href="{{url('admin/classrooms')}}" @if(Session::get('subpage')==="classrooms")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  Class Rooms
                            </a>
                        </li> @endcan 
                        @can('create-classroom')
                        <li>
                            <a href="{{url('admin/add-edit-classroom')}}" @if(Session::get('subpage')==="add-classroom")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  Create New Class Room
                            </a>
                        </li> @endcan                         
                    </ul>                    
                </li>  
               @endcan 
                
                @can('view-subject')
                <li class="app-sidebar__heading"> Course Management</li>  
                <li>
                    <a href="#" @if(Session::get('page')==="course") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Subjects 
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="course") class="mm-show" @endif >
                      @can('view-subject')
                        <li>
                            <a href="{{url('admin/subjects')}}" @if(Session::get('subpage')==="subjects")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  View Subjects
                            </a>
                        </li> @endcan 
                        
                        @can('create-subject')
                        <li>
                            <a href="{{url('admin/add-edit-subject')}}"  @if(Session::get('subpage')==="add_subject")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Create New Subject
                            </a>
                        </li>  @endcan
                        
                        @can('define-class-subject')
                        <li>
                            <a href="{{url('admin/manage-subject-for-levels')}}"  @if(Session::get('subpage')==="subjects-for-level")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Define Subject For Levels
                            </a>
                        </li>  @endcan
                    </ul>                    
                </li>  
               @endcan 
               
               @can('view-question')
                <li>
                    <a href="#" @if(Session::get('page')==="questions") class="mm-active" @endif >
                        <i class="metismenu-icon fa fa-database"></i>
                        Questions
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="questions") class="mm-show" @endif>
                     @can('import-question')
                        <li>
                            <a href="{{url('admin/questions/import')}}"  @if(Session::get('subpage')==="import") class="mm-active" @endif >
                                <i class="metismenu-icon">
                                </i>Import Questions
                            </a>
                        </li>                        
                        @endcan
                        @can('view-question')<li>
                            <a href="{{url('admin/questions/view')}}"  @if(Session::get('subpage')==="question-view") class="mm-active" @endif >
                                <i class="metismenu-icon">
                                </i>View Question
                            </a>
                        </li>
                        @endcan                         
                    </ul>
                </li> @endcan
                 @can('view-exam-schedule')
                <li>
                    <a href="#" @if(Session::get('page')==="schedules") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-alarm"></i>
                        Exam Schedules  
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="schedules") class="mm-show" @endif >
                       @can('view-exam-schedule')
                        <li>
                            <a href="{{url('admin/schedules')}}" @if(Session::get('subpage')==="schedules")  class="mm-active"  @endif >
                                <i class="metismenu-icon"></i>
                                  View Schedules
                            </a>
                        </li>
                        @endcan 
                        @can('create-exam-schedule')
                        <li>
                            <a href="{{url('admin/add-edit-schedule')}}"  @if(Session::get('subpage')==="addschedule")  class="mm-active"  @endif>
                                <i class="metismenu-icon">
                                </i>  Create New Schedule
                            </a>
                        </li>                       
                        @endcan
                    </ul>
                </li> 
                @endcan
                
                @can('view-student')
                <li class="app-sidebar__heading"> Student Management </li>
                 <li>
                    <a href="#" @if(Session::get('page')==="students") class="mm-active" @endif >
                        <i class="metismenu-icon pe-7s-users"></i>
                        Students  
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul  @if(Session::get('page')==="students") class="mm-show" @endif >
                       @can('create-student')
                        <li>
                           <a href="{{url('admin/add-new-student')}}" @if(Session::get('subpage')==="student-add") class="mm-active" @endif >
                               <i class="metismenu-icon pe-7s-user"></i>
                               Create New Student
                           </a>
                       </li>
                       @endcan
                        @can('view-student')
                        <li>
                           <a href="{{url('admin/students')}}"   @if(Session::get('subpage')==="students") class="mm-active" @endif >
                                <i class="metismenu-icon pe-7s-user"></i>
                                View All Students
                            </a>
                        </li> @endcan 
                        
                       @can('import-student')
                        <li>
                           <a href="{{url('admin/students/import')}}" @if(Session::get('subpage')==="student-import") class="mm-active" @endif >
                               <i class="metismenu-icon pe-7s-user"></i>
                               Import New Students
                           </a>
                       </li>
                       @endcan                       
                    </ul>                    
                </li>                
                @endcan
                
                 <li class="mb-5 mt-3">
                    <a onclick="return confirm('Do You Want To Logout Now ?')" href="{{url('portal/logout')}}" class=" text-danger font-weight-600" >
                        <i class="metismenu-icon pe-7s-power text-danger font-weight-600"></i>
                        Logout                          
                    </a>      
                </li>  
            </ul>
        </div>   
</div>   