<div class="app-header header-shadow bg-plum-plate" style="color:#fff;">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner text-white"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner text-white"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6 text-white"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <!--<div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> -->
                    <ul class="header-menu nav">
                        <li class="dropdown nav-item">
                            <a href="{{url('admin/dashboard')}}" class="nav-link  font-weight-bold text-white">
                                <i class="nav-link-icon pe-7s-home pe-2x font-weight-700 text-white"></i>
                                <span class=" font-weight-700" style="color: #fff;"> {{ strtoupper(str_replace('_',' ',env('APP_NAME')))}} </span>
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                             <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a aria-haspopup="true" aria-expanded="true" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="false" class="dropdown-menu dropdown-menu-right">
                                             <a  href="{{url('portal/logout')}}"  class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left font-weight-bold ml-3 header-user-info">
                                    <div class="widget-heading" style="color: #fff;">
                                          {{ admin_info(Auth::guard('admin')->user()->id)['fullname']}}
                                    </div>
                                    <div class="widget-subheading font-weight-bold" style="color: #fff;">
                                      {{ ucfirst(Auth::guard('admin')->user()->email)}}
                                    </div>
                                </div>
                                 <div class="widget-content-right header-user-info ml-3">
                                    <a onclick="return confirm('Do You Want To Logout Now ?')" href="{{url('portal/logout')}}" title="Logout"  class=" p-1 btn btn-danger btn-lg ">
                                        <i class="pe-7s-power pe-2x text-white font-weight-bold"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
