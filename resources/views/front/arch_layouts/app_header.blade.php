<div class="app-header header-shadow">
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
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="{{url('admin/questions/view')}}" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Questions
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="{{url('admin/subjects')}}" class="nav-link">
                                <i class="nav-link-icon pe-7s-notebook pe-2x"></i>
                                Subjects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="{{url('admin/schedules')}}" class="nav-link">
                                <i class="nav-link-icon pe-7s-alarm pe-2x"></i>
                                Schedules
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                             <a  href="{{url('portal/logout')}}"  class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                          {{ users_name(Auth::guard('student')->user()->id) }}   
                                    </div>
                                    <div class="widget-subheading">
                                      
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <a onclick="return confirm('Do You Want To Logout Now ?')" href="{{url('portal/logout')}}" title="Logout"  class=" p-1 btn btn-danger btn-lg ">
                                        <i class="pe-7s-power pe-2x text-white font-weight-bold"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>  