<!-- Start Left Navbar  -->
<div class="wrappers">
            
            <nav class="navbar navbar-expand-md navbar-light">
                <button type="button" class="navbar-toggler ms-auto mb-2" data-bs-toggle="collapse" data-bs-target="#nav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="nav" class="navbar-collapse collapse">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Start Left Sidebar  -->
                            <div class="col-lg-2 col-md-3 fixed-top vh-100 overflow-auto sidebars">
                                <ul class="navbar-nav flex-column mt-4">
                                    <li class="nav-item nav-categories">Main</li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks currents"><i class="fas fa-tachometer-alt fa-md me-3"></i> Dashboard</a></li>
                                    
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#download"><i class="fas fa-tachometer-alt fa-md me-3"></i> Download <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="download" class="collapse">
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Education</a></li>
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Software</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#form"><i class="fas fa-tachometer-alt fa-md me-3"></i> Form <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="form" class="collapse">
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Att Form</a></li>
                                            <li><a href="{{route('leaves.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Leave Form</a></li>
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Enrolls</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-md me-3"></i> Widgets</a></li>

                                    <li class="nav-item nav-categories">UI Features</li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#article"><i class="fas fa-tachometer-alt fa-md me-3"></i> Articles <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="article" class="collapse">
                                            <li><a href="{{route(name: 'posts.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Posts</a></li>
                                            <li><a href="{{route(name:'announcements.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Announcement</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#student"><i class="fas fa-tachometer-alt fa-md me-3"></i> Students <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="student" class="collapse">
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> All Students</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-md me-3"></i> Popups</a></li>

                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#apps"><i class="fas fa-tachometer-alt fa-md me-3"></i> Apps <i class="fas fa-angle-left mores"></i></a>

                                            <ul id="apps" class="collapse">
                                                <li><a href="{{route(name:'contacts.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Contacts</a></li>
                                                <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Todo</a></li>
                                            </ul>
                                    </li>

                                    <li class="nav-item nav-categories">Data Represention</li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#analysis"><i class="fas fa-tachometer-alt fa-md me-3"></i> Fixed Analysis <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="analysis" class="collapse">

                                            <li><a href="{{route('days.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Days</a></li>

                                            <li><a href="{{route(name: 'categories.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Categories</a></li>

                                            <li><a href="{{route('genders.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Gender</a></li>

                                            <li><a href="{{Route('paymenttypes.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Payment Types</a></li>

                                            <li><a href="{{Route('stages.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Stages</a></li>                                            

                                            <li><a href="{{Route(name: 'tags.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Tags</a></li>

                                            <li><a href="{{Route('types.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Types</a></li>

                                            <li><a href="{{Route('statuses.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Statuses</a></li>

                                            <li><a href="{{Route('relatives.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Relative</a></li>
                                            
                                        </ul>

                                    </li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#addon"><i class="fas fa-tachometer-alt fa-md me-3"></i> Addon <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="addon" class="collapse">
                                            <li><a href="{{Route('religions.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Religion</a></li>
                                            <li><a href="{{Route(name: 'roles.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Roles</a></li>
                                            <li><a href="{{Route(name: 'warehouses.index')}}" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Warehouses</a></li>
                                            
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#map"><i class="fas fa-tachometer-alt fa-md me-3"></i> Maps <i class="fas fa-angle-left mores"></i></a>
                                        <ul id="map" class="collapse">
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Google Map</a></li>
                                            <li><a href="javascript:void(0);" class="nav-link text-white sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i> Vector Map</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            <!-- End Left Sidebar  -->

                            <!-- Start Top Sidebar  -->
                             @include('layouts.adminnavbar')
                            <!-- End Top Sidebar  -->

                        </div>
                    </div>

                    

                </div>
            </nav>
            

            
        </div>
        <!-- End Left Navbar  -->