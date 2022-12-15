<div class="sidebar-menu">
            <div class="sidebar-header" >   
              
                <div class="logo" style="width:100%;height:100%;">
                    @php
                        $company = DB::table('tbl_company_name')
                            ->select('company_name')
                            ->where('company_id', Auth::user()->company_id)
                            ->first();

                         
                                $var2 = DB::table('tbl_branch_list')
                                    ->select('branch_loc')
                                    ->where('branch_code' , Auth::user()->branch_code)
                                    ->first();
                            
                                    
                            if(Auth::user()->branch_code == NULL){
                                $branchname = "";
                            }else {
                                $var2 = DB::table('tbl_branch_list')
                                    ->select('branch_loc')
                                    ->where('branch_code' , Auth::user()->branch_code)
                                    ->first();

                                $branchname = $var2->branch_loc;
                            }
                          
                    @endphp
                    <a href="{{ route('main')}}"><img src="{{asset('assets/images/logo/logos.png')}}" alt="logo">{{ $company->company_name}} <br> {{ $branchname }}  </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="@if(Route::is('main')) active @elseif(Route::is('companycontents')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                                <ul class="collapse">
                                    <li class="@if(Route::is('main')) active @endif"><a href="{{route('main')}}">Dashboard</a></li>
                                    <li class="@if(Route::is('companycontents')) active @endif"><a href="{{ route('companycontents') }}">Company List</a></li>
                                    
                  
                                </ul>
                            </li>
                            <li class="@if(Route::is('attendancecontent')) active @elseif (Route::is('teamcontent')) active @elseif (Route::is('projectmanagercontent')) active @elseif (Route::is('projectengineercontent')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-direction-alt"></i> <span>Project Sites</span></a>
                                <ul class="collapse">
                            
                                    <li class="@if(Route::is('attendancecontent')) active @endif"><a href="{{ route('attendancecontent') }}">Department List</a></li>
                                    <li class="@if(Route::is('teamcontent')) active @endif"><a href="{{ route('teamcontent') }}">Operation Manager</a></li>
                                    <li class="@if(Route::is('projectmanagercontent')) active @endif"><a href="{{ route('projectmanagercontent') }}">Project Manager List</a></li>
                                    <li class="@if(Route::is('projectengineercontent')) active @endif"><a href="{{ route('projectengineercontent') }}">Project Engineer List</a></li>
                                    {{-- <li class="@if(Route::is('position')) active" @endif><a href="{{ route('position') }}">Position</a></li> --}}
                                </ul>
                            </li>
                            
                            <li class="@if(Route::is('companycontent')) active @elseif (Route::is('districtcontent')) active @elseif (Route::is('areacontent')) active @elseif (Route::is('branchcontent')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Ever First Branches</span></a>
                                <ul class="collapse">
                            
                                    <li class="@if(Route::is('companycontent')) active @endif"><a href="{{ route('companycontent') }}">Company List</a></li>
                                    <li class="@if(Route::is('districtcontent')) active @endif"><a href="{{ route('districtcontent') }}">District List</a></li>
                                    <li class="@if(Route::is('areacontent')) active @endif"><a href="{{ route('areacontent') }}">Area List</a></li>
                                    <li class="@if(Route::is('branchcontent')) active @endif"><a href="{{ route('branchcontent') }}">Branch List</a></li>
                                  {{-- <li class="@if(Route::is('position')) active" @endif><a href="{{ route('position') }}">Position</a></li> --}}
                                </ul>
                            </li>
                            
                            {{-- <li class="@if(Route::is('companycontent')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-alarm-clock"></i> <span>Manage Time In\Out </span></a>
                                <ul class="collapse">
                                    <li class="@if(Route::is('companycontent')) active @endif"><a href="{{ route('companycontent') }}">Company List</a></li>
                            </ul>
                            </li>

                            <li class="@if(Route::is('companycontent')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i> <span>User Management</span></a>
                                <ul class="collapse">
                                    <li class="@if(Route::is('companycontent')) active @endif"><a href="{{ route('companycontent') }}">Company List</a></li>
                            </ul>
                            </li> --}}
                         
                          
                            
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>