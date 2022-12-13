@extends('template.main')

@section('content')


@include('modal.AddProjectEmployee')
@include('modal.AddTeamModal')
@include('modal.AddTimeLimitModal')
@include('modal.AddCompanyModal')
@include('modal.AddDepartmentModal')
@include('modal.AddPositionsModal')
@include('modal.SyncingServerModal')
@include('modal.NotificationModal')

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>


{{-- <script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = false;

var pusher = new Pusher('ff39d932b66ef995b09a', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  // alert(JSON.stringify(data));
  $('#syncmodal').modal('show')
});
</script> --}}

<input type="text" id="localusercount" name="localusercount" hidden>
<input type="text" id="cusercounts" name="cusercounts" hidden>

<input type="text" id="absentscount" name="absentscount" hidden>


@if (Auth::user()->role == 1)
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Company Management:</h3>
<button type="button" class="btn btn-info" id="addcompanyclicker" onclick="addcompanymodal()" > 
    Add New Company
  </button>
  {{-- <button type="button" class="btn btn-info" id="addcompanyclicker" onclick="addcompanymodal()" > 
    Add New Branch
  </button> --}}
        </div>
        <div class="col-6">
    <h3>User Management:</h3>
  <button type="button" class="btn btn-primary" onclick="addengineersmodal()"  > 
    Add new employee
  </button>
  <button type="button" class="btn btn-primary" onclick="adddepartmentmodal()" > 
    Add New Department
  </button>
  <button type="button" class="btn btn-primary" onclick="addpositionsmodal()" > 
    Add New Position
  </button>
        </div>
    </div>
</div>

@elseif(Auth::user()->role == 2)
@php
if(!$sock = @fsockopen('www.google.com', 80))
{
     //Youre not connected in the internet
@endphp
    <div class="container">
    <div class ="row">
        <div class ="col-6">
            <h3>Cloud Management:</h3>
            <button type="submit" class="btn btn-success" name="syncinglogs" id="syncinglogs" disabled>Sync the logs to cloud</button>
        </div>
    </div>
</div>
@php
}
else
{
    @endphp

<div class="container">
    <div class ="row">
        <div class ="col-6">
            <h3>Cloud Management:</h3>
            <button type="submit" class="btn btn-success" name="syncinglogs" id="syncinglogs">Sync the logs to cloud</button>
        </div>
    </div>
</div>
@php
}
@endphp
@endif
{{-- hidden present value of the employee --}}
<h2 name="presentcount" id="presentcount" hidden></h2>
     
<div class="sales-report-area mt-5 mb-5">
            <div class="row">
               @if(Auth::user()->role == 1)
               <div class="col-md-4" >
                <div class="single-report mb-xs-30" style="background-color:white;">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Registered Location</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            {{-- <h2 name="companycount" id="companycount"> --}}
                                    {{-- </h2> --}}
                                     <h2 name="latecount" id="latecount"> </h2>
                        
                        </div>
                    </div>
                
                    <img src="{{asset('assets/images/svg/compass.svg')}}" style="width:33%;margin-left:38%;">
                </div>
            </div>


            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                    
                        <div class="s-report-title d-flex justify-content-between">
                            {{-- <h4 class="header-title mb-0">Branches</h4>  --}}
                            <h4 class="header-title mb-0">Company</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                        {{-- <h2 class="branchescount"></h2>  --}}
                        <h2 id="earlyoutcount"></h2>
                        </div>
                    </div>
                    <img src="{{asset('assets/images/svg/building.svg')}}" style="width:33%;margin-left:38%;">
                </div>
            </div>

               @elseif(Auth::user()->role == 2 || Auth::user()->role == 3)
                <div class="col-md-4" >
                    <div class="single-report mb-xs-30" style="background-color:white;">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                            
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Late</h4>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                {{-- <h2 name="companycount" id="companycount"> --}}
                                        {{-- </h2> --}}
                                         <h2 name="latecount" id="latecount"> </h2>
                            
                            </div>
                        </div>
                    
                        <img src="{{asset('assets/images/svg/clipboard2-minus.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                        
                            <div class="s-report-title d-flex justify-content-between">
                                {{-- <h4 class="header-title mb-0">Branches</h4>  --}}
                                <h4 class="header-title mb-0">Early Out</h4>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                            {{-- <h2 class="branchescount"></h2>  --}}
                            <h2 id="earlyoutcount"></h2>
                            </div>
                        </div>
                        <img src="{{asset('assets/images/svg/clock-history.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                        
                <div class="col-md-4">
                    <div class="single-report">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                           <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Users</h4>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                            <h2 id="userscount"></h2>
                            </div>
                        
                          
                        </div>
                        <img src="{{asset('assets/images/svg/person-circle.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>

                @elseif(Auth::user()->role == 3)
                <div class="col-md-4">
                    <div class="single-report">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                           <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Company</h4>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                            <h2 id="companycount"></h2>
                            </div>
                        
                          
                        </div>
                        <img src="{{asset('assets/images/svg/building.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>
                @endif 



            </div>
        </div>


        <!-- sales report area end -->
        @if(Auth::user()->role == 1)
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">Overview</h4>
                       
                        </div>
                        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_gjsy1lag.json" mode="bounce" background="transparent"  speed="1"  style="width: 100%; height: 400px;"  loop  autoplay></lottie-player>

                       </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 coin-distribution">
                <div class="card h-full">
                    <div class="card-body">
                        <h4 class="header-title mb-0">Time Logs</h4>
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_w9exmcol.json"  background="transparent"  speed="1"  style="width: 100%; height: 400px;"  loop autoplay></lottie-player>  </div>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->role == 2 || Auth::user()->role == 3)
        <!-- overview area start -->
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <div id="chartContainer" style="height: 450px; width: 100%;"></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> --}}

                        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div> <canvas id="chart-line" width="299" height="115" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>


                       </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 coin-distribution">
                <div class="card h-full">
                    <div class="card-body">
                        <h4 class="header-title mb-0">Time Logs</h4>
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_w9exmcol.json"  background="transparent"  speed="1"  style="width: 100%; height: 400px;"  loop autoplay></lottie-player>  </div>
                </div>
            </div>
        </div>
        <!-- overview area end -->
        @endif

        <div class="container mt-5">
            @if(Auth::user()->role == 2 || Auth::user()->role == 3)
            <h2 class="mb-4">Own Attendance Logs(Local Server)</h2>
            
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <form id = "ownfilter">
                <strong style="margin-left:2.5%;">Filter By :</strong>
                <select name="ownlastfilter" id="ownlastfilter">
                    <option value="" selected="selected" disabled></option>
                    <option value="Today">Today</option>
                    <option value="Yesterday">Yesterday</option>
                    <option value="Last15">Last 15 Days</option>
                    <option value="LastMonth">Last Month</option>
                </select>
                <strong style="margin-left:2.5%;">Date Range:</strong>
                <input type="date"  id="ownfromDate" name="ownfromDate">
                <strong>-</strong>
                <input type="date" id="owntoDate" name="owntoDate">
                <button style="margin-left:2.5%;" type="submit" class="btn btn-primary">Filter</button>
                <button  type="button" class="btn btn-danger" name="ownclearfilter" id="ownclearfilter">Reset Filter</button>
            </form>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Date</th>
                        <th>Time</th> 
                        <th>Status</th>
                        <th>Biometrics Location</th>
                        <th>Type</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
            <br></br>
    @endif
     @php 
     if(Auth::user()->role == 2){
        echo '   
        <h2 class="mb-4">Local Attendance Logs</h2>
        <form id = "attendancefilter">
            <strong style="margin-left:2.5%;">Filter By :</strong>
            <select name="lastfilter" id="lastfilter">
                <option value="" selected="selected" disabled></option>
                <option value="Today">Today</option>
                <option value="Yesterday">Yesterday</option>
                <option value="Last15">Last 15 Days</option>
                <option value="LastMonth">Last Month</option>
            </select>
            <strong style="margin-left:2.5%;">Date Range:</strong>
            <input type="date"  id="fromDate" name="fromDate">
            <strong>-</strong>
            <input type="date" id="toDate" name="toDate">
            <button style="margin-left:2.5%;" type="submit" class="btn btn-primary">Filter</button>
            <button  type="button" class="btn btn-danger" name="clearfilter" id="clearfilter">Reset Filter</button>
        </form>
        <div class ="data-tables datatable-dark">
        <table class="table table-bordered" id="localtable">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Date</th>
                    <th>Time</th> 
                    <th>Status</th>
                    <th>Biometrics Location</th>
                    <th>Type</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>    ';
     }
           
    @endphp
        {{-- This php hides the table using session --}}


        @php
if(Auth::user()->role == 1){
echo '<h2 class="mb-4">All Attendance Logs</h2>

            <form id = "cloudfilter">';
    //             <strong style="margin-left:2.5%;">Location :</strong>
    // <select name="locationfilter" id="locationfilter">
    //     <option value="" selected="selected" disabled></option>

    // foreach ($locationfilter as $item){
    //     echo ' <option value="'.$item->serialno.'">'.$item->location.'</option>';
    // }
echo '
    </select>
            <strong style="margin-left:2.5%;">Filter By :</strong>
            <select name="cloudlastfilter" id="cloudlastfilter">
                <option value="" selected="selected" disabled></option>
                <option value="Today">Today</option>
                <option value="Yesterday">Yesterday</option>
                <option value="Last15">Last 15 Days</option>
                <option value="LastMonth">Last Month</option>
            </select>
            <strong style="margin-left:2.5%;">Date Range:</strong>
            <input type="date"  id="cloudfromDate" name="cloudfromDate">
            <strong>-</strong>
            <input type="date" id="cloudtoDate" name="cloudtoDate">
            <button style="margin-left:2.5%;" type="submit" class="btn btn-primary">Filter</button>
            <button  type="button" class="btn btn-danger" name="cloudclearfilter" id="cloudclearfilter">Reset Filter</button>
            </form>
            <br>
            <div class ="data-tables datatable-dark">
<table class="table table-bordered" id="cloudtable">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Date</th>
            <th>Time</th> 
            <th>Status</th>
            <th>Biometrics Location</th>
            <th>Type</th>
            <th>State</th>
        </tr>
    </thead>
    <tbody>
       
    </tbody>
</table>
</div>
';
}

@endphp
     
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script>
            function clearsform(){
                document.getElementById('adduserform').reset();
                resetform();
            }

            function resetform(){
            //     $('input[name=useremployee]').val('');
            //     $('input[name=branchline]').attr('checked', false);
            //      document.getElementById('useremployee').value = "";
            //      document.getElementById('NameUser').value = "";
            //      document.getElementById('EmailUser').value = "";
            //      document.getElementById('UsernameUser').value = "";
            //      document.getElementById('PasswordUser').value = "";
            //      document.getElementById('team').value = "";
            //      document.getElementById('OIC').value = "";
            //      document.getElementById('ProjectManager').value = "";
            //      document.getElementById('area').value = "";
            //      document.getElementById('district').value = "";
            //      document.getElementById('branch').value = "";
            //      document.getElementById('position').value = "";
            // //    //Project Site Option Clear
            // document.getElementById('useremployee').disabled = "true";
            //      document.getElementById('NameUser').disabled = "true";
            //      document.getElementById('EmailUser').disabled = "true";
            //      document.getElementById('UsernameUser').disabled = "true";
            //      document.getElementById('PasswordUser').disabled = "true";
            //      document.getElementById('OIC').disabled = "true";
            //      document.getElementById('ProjectManager').disabled = "true";
            //      document.getElementById('team').style.display = "none";
            //      document.getElementById('lteam').style.display = "none";
            //      document.getElementById('OIC').style.display = "none";
            //      document.getElementById('lOIC').style.display = "none";
            //      document.getElementById('ProjectManager').style.display = "none";
            //      document.getElementById('lPM').style.display = "none";
            //        //Branches Option Clear 
            //      document.getElementById('area').disabled = "true";   
            //      document.getElementById('branch').disabled = "true";
            //      document.getElementById('ldistrict').style.display= "none";
            //      document.getElementById('district').style.display= "none";
            //      document.getElementById('larea').style.display= "none";
            //      document.getElementById('area').style.display= "none";
            //      document.getElementById('lbranch').style.display= "none";
            //      document.getElementById('branch').style.display= "none";
            }

            function resetemployeeform(){
                //Radio button unchecked
                $('input[name=addbranchline]').attr('checked', false);
                $('input[name=addprojectlines]').attr('checked', false);
                $('input[name=addroleline]').attr('checked', false);
                $('#addcompany').val('');
                $('#copydetails').val('');
                document.getElementById('addEmpid').value = "";

                
                //Add new Employee UserDetails Cleared
                $('#AddNameUser').val('');
                $('#AddEmailUser').val('');
                $('#AddUsernameUser').val('');
                $('#AddPasswordUser').val('');
                $('#addEmpid').attr('disabled', true);


                //Add new Employee Project Sites Cleared And Hide
                $('#addteam').val('');
                $('#addOIC').val('');
                $('#addProjectManager').val('');
                $('#laddOIC').hide();
                $('#laddPM').hide();
                $('#laddteam').hide();
                $('#laddProjectManager').hide();
                $('#addpositions').hide();
                $('#addOIC').hide();
                $('#addteam').hide();
                $('#addProjectManager').hide();

            
                //Add new Employee Branch Cleared And Hide
                $('#lpositions').hide();
                $('#positions').hide();
                $('#ldepartment').hide();
                $('#department').hide();
                $('#adddistrict').hide();
                $('#addarea').hide();
                $('#addbranch').hide();
                $('#ladddistrict').hide();
                $('#laddarea').hide();
                $('#laddbranch').hide();
                $('#positions').val('');
                $('#department').val('');
                $('#adddistrict').val('');
                $('#addarea').val('');
                $('#addbranch').val('');
                $('#positions').attr('disabled', true);
                
              


                //Add new Employee Head Office Cleared And Hide
                $('#laddposition').hide();
                $('#addposition').hide();
                $('#addposition').val('');  
            }
        </script>

        <script>
        $(document).ready(function () {
          


            
            $('#syncinglogs').on('click', function(e){
                e.preventDefault();

                window.open('https://www.acs.multi-linegroupofcompanies.com/samplelogs');
            })

            $('#syncform').on('submit', function(e){
            e.preventDefault();
        var getdata = [];

      



            $.get("https://www.acs.multi-linegroupofcompanies.com/userstocloud", function( data ) {
              
                // getdata = data;  
                ajaxCloud(data);
                })
 
    })
        function ajaxCloud(f_data) {
        
        //     for(i = 0;i<5;i++){
        //         test = f_data[i].id;
        //         console.log(test)
        //     }
        //    return;
            data = f_data;
            $.ajax({
                
                type: 'GET',
                url: '/userscloudfunction',
                data: {'req' : data},
                success:function(response){
                    $('#syncingmodal').modal('hide');
                    Swal.fire({
                      icon: 'success',
                      title: 'Your work has been saved',
                      showConfirmButton: false,
                      timer: 2000
                })
            }
            });
        }


           
@if (Auth::user()->role == 2)    

@php

if(!$sock = @fsockopen('www.google.com', 80))
{
//Youre not connected in the internet
// echo " $('#addengineersmodal').modal('show')";
echo "$('#notifmodal').modal('show')";

}
else
{

// @foreach($userchecking as $item)

// @endforeach
// Connected in the internet
// $cloudcount = DB::Connection('mysql2')->table('users')->where('bioloc_id', Auth::user()->bioloc_id)->count();
// $localcount = DB::Connection('mysql')->table('users')->where('bioloc_id', Auth::user()->bioloc_id)->count();

// if($localcount != $cloudcount){
//     echo "$('#syncingmodal').modal('show')";
// }
@endphp

$.get( "https://www.acs.multi-linegroupofcompanies.com/userstocloud", function( data ) {
    syncingcount(data);
    userscount();
 
    })
    setTimeout(function() { 
        var localcount =  $('#localusercount').val();
        var cloudcount = $('#cusercounts').val();

        if(cloudcount != localcount){


        $('#syncingmodal').modal('show');
 
}
}, 1500);
@php
}
@endphp
@endif


            $('#ownlastfilter').on('change', function(){
            $('#ownfromDate').val('');
            $('#owntoDate').val('');
            })

            $('#ownfromDate').on('change', function(){
              $('#ownlastfilter').val('');  
            })

            $('#owntoDate').on('change', function(){
              $('#ownlastfilter').val('');
            })

            //Own clear Filter
            $('#ownclearfilter').on('click', function(){
            $('#ownfromDate').val('');
            $('#owntoDate').val('');
            $('#ownlastfilter').val('');

                $('.yajra-datatable').DataTable().clear();
                $('.yajra-datatable').DataTable({
                    // orderable: true, 
                    // searchable: true,
                    // processing: true,
                    // serverSide: true,
                    destroy:true,
                    
                    // ajax: '{{route('fetchlocal')}}',
                    
                    // columns: [
                    //     {data: 'empid'},
                    //     {data: 'date'}, 
                    //     {data: 'time'},
                    //     {data: 'status'},
                    //     {data: 'serial_no'},
                    //     {data: 'type'},
                    //     {data: 'state'}, 
                    // ]
                });
            })
            
            //Cloud Clear Filter
            $('#cloudclearfilter').on('click', function(){
            $('#cloudfromDate').val('');
            $('#cloudtoDate').val('');
            $('#cloudlastfilter').val('');
            $('#locationfilter').val('');

                $('#cloudtable').DataTable().clear();
                $('#cloudtable').DataTable({
                    // orderable: true, 
                    // searchable: true,
                    // processing: true,
                    // serverSide: true,
                    destroy:true,
                    
                    // ajax: '{{route('fetchlocal')}}',
                    
                    // columns: [
                    //     {data: 'empid'},
                    //     {data: 'date'}, 
                    //     {data: 'time'},
                    //     {data: 'status'},
                    //     {data: 'serial_no'},
                    //     {data: 'type'},
                    //     {data: 'state'}, 
                    // ]
                });

            
       
        })


       
      // Local Clear Filter
        $('#clearfilter').on('click', function(){
            $('#fromDate').val('');
            $('#toDate').val('');
            $('#lastfilter').val('');

            $('#localtable').DataTable().clear();
            $('#localtable').DataTable({
                // orderable: true, 
                // searchable: true,
                // processing: true,
                // serverSide: true,
                destroy: true,
                // ajax: '{{route('fetchlocal')}}',
                
                // columns: [
                //     {data: 'empid'},
                //     {data: 'date'}, 
                //     {data: 'time'},
                //     {data: 'status'},
                //     {data: 'serial_no'},
                //     {data: 'type'},
                //     {data: 'state'}, 
                // ]
            });

            
       
        })


        // Automatic filter in filter by in local attendance
        // $('#lastfilter').on('change', function(){
        //     $('#fromDate').val('');
        //     $('#toDate').val('');

        //     $('#localtable').DataTable({
        //         orderable: true, 
        //         searchable: true,
        //         processing: true,
        //         destroy: true,
        //         serverSide: true,
        //         ajax: {
        //             type: 'GET',
        //             data: {'from':$('#fromDate').val() , 'to':$('#toDate').val(), 'filter':$('#lastfilter').val() },
        //             url : '{{route('attendancefilter')}}'
        //         },
        //         columns: [
        //             {data: 'empid', searchable: true},
        //             {data: 'date'}, 
        //             {data: 'time'},
        //             {data: 'status'},
        //             {data: 'serial_no'},
        //             {data: 'type'},
        //             {data: 'state'}, 
        //         ]
        //     });
        // })

        $('#fromDate').on('change', function(){
            $('#lastfilter').val('');
        })

        $('#toDate').on('change', function(){
            $('#lastfilter').val('');
        })

        //Local Filter
        $('#attendancefilter').on('submit', function(e){
          e.preventDefault();
          
            data = $('#attendancefilter').serializeArray();
            var datefrom = $('#fromDate').val();
            var dateto = $('#toDate').val();
            var lastfilter = $('#lastfilter').val();

            
      
            if(datefrom == "" && dateto == "" && lastfilter == null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range:',
                        })
                 return;
            }
            else if(datefrom >= dateto && lastfilter == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Invalid input of Date To:',
                        })
                        $('#toDate').val('');
                        return;
            }

    
            $('#localtable').DataTable({
                paging: false,
                orderable: true, 
                searchable: true,
                processing: true,
                scrollY:        '20%',
                deferRender:    true,
                scroller:       true,
                destroy: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    data: {'from':$('#fromDate').val() , 'to':$('#toDate').val(), 'filter':$('#lastfilter').val() },
                    url : '{{route('attendancefilter')}}'
                },
                columns: [
                    {data: 'empid', searchable: true},
                    {data: 'date'}, 
                    {data: 'time'},
                    {data: 'status'},
                    {data: 'serial_no'},
                    {data: 'type'},
                    {data: 'state'}, 
                ]
            });
        })

        //cloudfilter
        $('#cloudfromDate').on('change', function(){
            $('#cloudlastfilter').val('');
        });
        $('#cloudtoDate').on('change', function(){
            $('#cloudlastfilter').val('');
        });
        $('#cloudlastfilter').on('change', function(){
            $('#cloudfromDate').val('');
            $('#cloudtoDate').val('');
        })

        $('#cloudfilter').on('submit', function(e){
          e.preventDefault();
          
            data = $('#cloudfilter').serializeArray();
            var datefrom = $('#cloudfromDate').val();
            var dateto = $('#cloudtoDate').val();
            var lastfilter = $('#cloudlastfilter').val();
            var location = $('#locationfilter').val();
            
            if(datefrom == "" && dateto == "" && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Select Filter to show the data',
                        })
                 return;
            }else if (datefrom == "" && dateto != "" && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly:',
                        })
                 return;

            }
            else if(datefrom >= dateto && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Invalid input of Date To:',
                        })
                        $('#toDate').val('');
                        return;
            }

            else if(datefrom != "" && dateto == "" && lastfilter == null && location != null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly: (Location Selected)',
                        })
                 return;
            }
            
            else if (datefrom == "" && dateto != "" && lastfilter == null && location != null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly: (Location Selected)',
                        })
                 return;

            }

    
            $('#cloudtable').DataTable({
                paging: false,
                orderable: true, 
                searchable: true,
                processing: true,
                destroy: true,
                scrollY:        '50vh',
                deferRender:    true,
                scroller:       true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    data: {'from':$('#cloudfromDate').val() , 'to':$('#cloudtoDate').val(), 'filter':$('#cloudlastfilter').val(), 'location':$('#locationfilter').val() },
                    url : '{{route('cloudfilter')}}'
                },
                columns: [
                    {data: 'empid', searchable: true},
                    {data: 'date'}, 
                    {data: 'time'},
                    {data: 'status'},
                    {data: 'serial_no'},
                    {data: 'type'},
                    {data: 'state'}, 
                ]
            });

            return false;
        })

         //ownfilter
         $('#ownfilter').on('submit', function(e){
          e.preventDefault();
          
            data = $('#ownfilter').serializeArray();
            var datefrom = $('#ownfromDate').val();
            var dateto = $('#owntoDate').val();
            var lastfilter = $('#ownlastfilter').val();

            
      
            if(datefrom == "" && dateto == "" && lastfilter == null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range:',
                        })
                 return;
            }
            else if(datefrom >= dateto && lastfilter == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Invalid input of Date To:',
                        })
                        $('#owntoDate').val('');
                        return;
            }

    
            $('.yajra-datatable').DataTable({
                paging: false,
                orderable: true, 
                searchable: true,
                processing: true,
                scrollY:       '20%',
                deferRender:    true,
                scroller:       true,
                destroy: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    data: {'from':$('#ownfromDate').val() , 'to':$('#owntoDate').val(), 'filter':$('#ownlastfilter').val() },
                    url : '{{route('ownfilter')}}'
                },
                columns: [
                    {data: 'empid', searchable: true},
                    {data: 'date'}, 
                    {data: 'time'},
                    {data: 'status'},
                    {data: 'serial_no'},
                    {data: 'type'},
                    {data: 'state'}, 
                ]
            });

            return false;
        })


        @if (Auth::user()->role == 1)
        $.ajax({
                type: 'GET',
                url: '{{route('clouduserscount')}}',
                success: function(response){
                    $('#userscount').html(response);
                }
            })
        @elseif (Auth::user()->role == 2)
            $.ajax({
                type: 'GET',
                url: '{{route('userscount')}}',
                success: function(response){
                    $('#userscount').html(response);
                }
            })

        $.ajax({
            type:'GET',
            url: '{{route('fetchabsentcount')}}',
            success:function(response){
                $('#absentscount').val(response);
            }
        })

        @endif
            $.ajax({
                type: 'GET',
                url: '{{route('ontimecount')}}',
                success: function(response){
                    $('#presentcount').html(response);
                }
                
            })

            $.ajax({
                type: 'GET',
                url: '{{route('companycount')}}',
            
                success: function(response){
                    $('#companycount').html(response);
                    
                }
            })
            $.ajax({
                type: 'GET',
                url: '{{route('branchescount')}}',
            
                success: function(response){
                    $('.branchescount').html(response);
                    
                }
            })
@php
            //Role seperator
            //IF Superadmin login
            if(Auth::user()->role == 1){
         //Checking of the internet
         if(!$sock = @fsockopen('www.google.com', 80))
        {
            //Youre not connected in the internet
         }
        else
        {
          //Connected
        echo '$.ajax({ type: "GET", url: "/latecount", success: function(response){ $("#latecount").html(response); }});'; 

        echo '$.ajax({type: "GET",url: "/earlyoutcount",success: function(response){$("#earlyoutcount").html(response); }});';
        }
            } 
            //IF Admin loging
            else if(Auth::user()->role == 2){
         //Checking of the internet
        if(!$sock = @fsockopen('www.google.com', 80))
        {
            //Youre not connected in the internet
        echo '$.ajax({ type: "GET", url: "/locallatecount", success: function(response){ $("#latecount").html(response);}});';
        
        echo '$.ajax({type: "GET",url: "/localearlyoutcount",success: function(response){$("#earlyoutcount").html(response);}});';
        
         }
        else
        {
          //Connected
          echo '$.ajax({ type: "GET", url: "/locallatecount", success: function(response){ $("#latecount").html(response);}});';

          echo '$.ajax({type: "GET",url: "/localearlyoutcount",success: function(response){$("#earlyoutcount").html(response);}});';
        
        }
            }else if(Auth::user()->role == 3){
         //Checking of the internet
        if(!$sock = @fsockopen('www.google.com', 80))
        {
            //Youre not connected in the internet
            echo '$.ajax({ type: "GET", url: "/latecount", success: function(response){ $("#latecount").html(response); }});'; 
           echo ' $.ajax({ type:"GET", url: "/fetchabsentcount", success:function(response){ $("#absentscount").val(response);} })';

        echo '$.ajax({type: "GET",url: "/earlyoutcount",success: function(response){$("#earlyoutcount").html(response); }});';

         }
        else
        {
          //Connected
          echo '$.ajax({ type: "GET", url: "/latecount", success: function(response){ $("#latecount").html(response); }});'; 
        echo '$.ajax({type: "GET",url: "/earlyoutcount",success: function(response){$("#earlyoutcount").html(response); }});';
        echo ' $.ajax({ type:"GET", url: "/fetchabsentcount", success:function(response){ $("#absentscount").val(response);} })';


        }
            }

          
@endphp
           
         

            
            

            $('#localtable').DataTable({
                // orderable: true, 
                // searchable: true,
                // processing: true,
                // serverSide: true,
                // ajax: '{{route('fetchlocal')}}',
                
                // columns: [
                //     {data: 'empId', sType: "numeric"},
                //     {data: 'date'}, 
                //     {data: 'time'},
                //     {data: 'status'},
                //     {data: 'serial_no'},
                //     {data: 'type'},
                //     {data: 'state'}, 
                // ], "drawcallback":function(settings){
                //     //loader
                //   alert ('Complete') ;
                    
                // }
            });

            $('.yajra-datatable').DataTable({
                // orderable: true, 
                // searchable: true,
                // processing: true,
                // serverSide: true,
                // ajax: '{{route('fetchspecific')}}',
                
                // columns: [
                //     {data: 'empId', sType: "numeric"},
                //     {data: 'date'}, 
                //     {data: 'time'},
                //     {data: 'status'},
                //     {data: 'serial_no'},
                //     {data: 'type'},
                //     {data: 'state'}, 
                // ],
               
            });

            $('#cloudtable').DataTable({
                // orderable: true, 
                // searchable: true,
                // processing: true,
                // serverSide: true,
                // ajax: '{{route('fetchcloud')}}',
                
                // columns: [
                //     {data: 'empId', sType: "numeric"},
                //     {data: 'date'}, 
                //     {data: 'time'},
                //     {data: 'status'},
                //     {data: 'serial_no'},
                //     {data: 'type'},
                //     {data: 'state'}, 
                // ]
            });

        //Add new Company Name Function
        $('#addcompanyform').on('submit', function(e){
            e.preventDefault();
            var data = $('#addcompanyform').serializeArray();

            $.ajax({
                type: 'POST',
                url: '{{route('addnewcompany')}}',
                data: data,
                success:function (response){
                    Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 2000

                    })

                    $('#addcompanymodal').modal('hide');
                    setTimeout(() => {
                    location.reload(); 
                    }, 2100);
                }
            })

        })

        //Add new Department Function

        $('#addteamform').on('submit', function(e){
            e.preventDefault();
            var data = $('#addteamform').serializeArray();

            $.ajax({
                type: 'POST',
                url: '{{route('addnewdepartment')}}',
                data: data,
                success: function(response){
                    Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    $('#addteammodal').modal('hide');
                }

            })

        })
        //Add new employee Function
            $('#addempform').on('submit', function(e){
                e.preventDefault();

                var data = $('#addempform').serializeArray();

                var loader = Swal.fire({
                title: 'Please Wait',       
                imageUrl: '{{asset('assets/images/logo/loading.gif')}}',
                imageWidth: 200,
                imageHeight: 400,
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false
        
                })

                $.ajax ({
                    type: 'POST',
                    url: '{{route('addnewemployeefunction')}}',
                    data: data,
                    success: function(response){
                        loader.close();
                        Swal.fire({
                    
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 2000
                        })
                        $('#addengineersmodal').modal('hide')
                        resetemployeeform();
                        location.reload();
                    },
                    error: function(e){
                        // e.sta
                    
                        if(e.status == 422){
                            var err = JSON.parse(e.responseText);
                            // console.log(err);
                            // console.log(e.responseJSON.length);
                            // console.log(e.responseJSON);
                            var data = [];
                            $.each(err.errors, function (key, value){
                                data.push(value);
                                console.log(value);
                            })
                            
                        Swal.fire({
                        icon: 'error',
                        title: 'Please fill up the form',
                        html: data.join("<br>"),
                        timer: 3000,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false
                        })

                        }else if(e.status == 500){
                        Swal.fire({
                        icon: 'error',
                        title: 'Internal Error',
                        timer: 3000,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false
                        })
                        }
                    
                        
                 
                        
                    }
                })


            })

            $.ajax({
                method: 'GET',
                url: '{{route('fetchattendancecount')}}',
                type: 'json',
                columns:[
                {data: 'count(empid)'},
                ],
                success:function($data){
                    $('.attendancecount').html($data);
                }
            });

           
            // $('input[name=branchline]').on('change', function(){
            //     var val = $(this).val();

  
            //     if(val == 'EverFirst') {
                
             

            //         $('#useremployee').attr('disabled', false);
            //         $('#NameUser').attr('disabled', false);
            //         $('#EmailUser').attr('disabled', false);
            //         $('#UsernameUser').attr('disabled', false);
            //         $('#PasswordUser').attr('disabled', false);
            //         $('#district').attr('disabled', false);

            //         $('#NameUser').attr('disabled', false);

                  

                 


            //         $('#ldistrict').show();
            //         $('#district').show();
            //         $('#larea').show();
            //         $('#area').show();
            //         $('#lbranch').show();
            //         $('#branch').show();
            //         $('#lposition').hide();
            //         $('#position').hide();
            //         $('#projectline').hide();
            //         $('#lOIC').hide();
            //         $('#lPM').hide();
            //         $('#lteam').hide();
            //         $('#OIC').hide();
            //         $('#team').hide();
            //         $('#ProjectManager').hide();
            //     }else if(val == 'HeadOffice')
            //     {
            //         $('#useremployee').attr('disabled', false);
            //         $('#NameUser').attr('disabled', false);
            //         $('#EmailUser').attr('disabled', false);
            //         $('#UsernameUser').attr('disabled', false);
            //         $('#PasswordUser').attr('disabled', false);
            //         $('#ldistrict').hide();
            //         $('#district').hide();
            //         $('#larea').hide();
            //         $('#area').hide();
            //         $('#lbranch').hide();
            //         $('#branch').hide();
            //         $('#projectline').hide();
            //         $('#lOIC').hide();
            //         $('#lPM').hide();
            //         $('#lteam').hide();
            //         $('#OIC').hide();
            //         $('#team').hide();
            //         $('#ProjectManager').hide();
            //         $('#lposition').show();
            //         $('#position').show();
            //     }else if(val == 'ProjectSite'){
            //         $('#useremployee').attr('disabled', false);
            //         $('#NameUser').attr('disabled', false);
            //         $('#EmailUser').attr('disabled', false);
            //         $('#UsernameUser').attr('disabled', false);
            //         $('#PasswordUser').attr('disabled', false);
            //         $('#ldistrict').hide();
            //         $('#district').hide();
            //         $('#larea').hide();
            //         $('#area').hide();
            //         $('#lbranch').hide();
            //         $('#branch').hide();
            //         $('#lposition').hide();
            //         $('#position').hide();
            //         $('#projectline').show();
            //         $('#lOIC').show();
            //         $('#lPM').show();
            //         $('#lteam').show();
            //         $('#OIC').show();
            //         $('#team').show();
            //         $('#ProjectManager').show();
            //     }

            //     $('input[name=branchlineval]').val(val);

            //     })

            $('#department').on('change', function(){
                var department = $(this).val();
                $.ajax({
                    type:'GET',
                    url:'{{route('positions')}}',
                    data: {'department': department},
                    success:function(response){
                        $('#positions').attr('disabled', false);
                        $('#positions').empty();
                        $('#positions').append('<option value="" selected="selected" disabled>Position List</option>')
                        $.each(response, function(index, data){
                            $('#positions').append('<option value="'+data.id+'">'+data.position_name+'</option>')
                        });
                    },
                })
            })

            $('#district').on('change', function(){
                var a = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('area')}}',
                    data: {'district': a},
                    success: function(response){
                        $('#area').attr('disabled', false);
                        $('#area').empty();
                        $('#branch').empty();
                        $('#area').append('<option value="" selected="selected" disabled>Area List</option>')
                        $.each(response, function(index, data) {
                            $('#area').append('<option value="'+data.area_code+'">'+data.area_no+'-'+ data.area_name+'</option>')
                        });
                },
                })
                })

            $('#area').on('change', function(){
                var area = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('branch')}}',
                    data:{'area_code':area},
                    success:function(response){
                        $('#branch').attr('disabled',false);
                        $('#branch').empty();
                        $('#branch').append('<option value="" selected="selected" disabled>Branch List</option>')
                        $.each(response, function(index, data) {
                            $('#branch').append('<option value="'+data.branch_code+'">'+data.branch_loc+'-'+ data.branch_head+'</option>')
                        });
                    }
                })
            //End of area on change function
            })
            //Project Site option
            $('#team').on('change', function(){
                var team = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('oic')}}',
                    data:   {'teamid': team},
                    success:function(response){
                        $('#OIC').attr('disabled', false);
                        $('#OIC').empty();
                        $('#ProjectManager').empty();
                        $('#OIC').append('<option value="" selected="selected" disabled>OIC List</option>')
                        $.each(response, function(index, data) {
                        $('#OIC').append('<option value="'+data.id+'">'+ data.name+'</option>')
                        });
                    }
                })
            })
            $('#OIC').on('change', function(){
                var oic = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('pm')}}',
                    data:   {'oicid':oic},
                    success:function(response){
                        $('#ProjectManager').attr('disabled', false);
                        $('#ProjectManager').empty();
                        $('#ProjectManager').append('<option value="" selected="selected" disabled>Project Manager List</option>')
                        $.each(response, function(index, data) {
                        $('#ProjectManager').append('<option value="'+data.id+'">'+ data.name+'</option>')
                        });
                    }
                })
            })
            $('#addpositions').hide();
        // ADD NEW EMPLOYEE
            // $('#addempform').on('submit', function(e){
            //     e.preventDefault();
            //     $id = $('#addEmpid').val();
            //     var data = $('#addempform').serializeArray();

            //     $.ajax({
            //         type:   'POST',
            //         url:    '{{route('addnewemployeefunction')}}',
            //         data:   data,
            //         success:function(response){
            //             $('#addengineersmodal').modal('hide');
            //         }
            //     })
            // })

        $('input[name=addbranchline]').on('change', function(){
            var vals = $(this).val();
        
            if(vals == 'EverFirst') {

                  
                    $('#department').attr('disabled', false);
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#adddistrict').attr('disabled', false);
                    $('#lpositions').show();
                    $('#positions').show();
                    $('#ladddistrict').show();
                    $('#adddistrict').show();
                    $('#laddarea').show();
                    $('#addarea').show();
                    $('#laddbranch').show();
                    $('#addbranch').show();

                    $('#laddposition').hide();
                    $('#addposition').hide();
                    $('#addpositions').hide();
                    
                    $('#addeverpositions').show();

                    $('#ldepartment').show();
                    $('#department').show();

                    $('#laddOIC').hide();
                    $('#laddProjectManager').hide();
                    $('#laddteam').hide();
                    $('#addOIC').hide();
                    $('#addteam').hide();
                    $('#addProjectManager').hide();
                }else if(vals == 'HeadOffice')
                {
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#addpositions').hide();
                    $('#addeverpositions').hide();
                    $('#lpositions').hide();
                    $('#positions').hide();
                    $('#ldepartment').hide();
                    $('#department').hide();
                    $('#ladddistrict').hide();
                    $('#adddistrict').hide();
                    $('#laddarea').hide();
                    $('#addarea').hide();
                    $('#laddbranch').hide();
                    $('#addbranch').hide();
                    $('#laddOIC').hide();
                    $('#laddPM').hide();
                    $('#laddteam').hide();
                    $('#addOIC').hide();
                    $('#addteam').hide();
                    $('#addProjectManager').hide();
                    $('#laddposition').show();
                    $('#addposition').show();
                }else if(vals == 'ProjectSite'){
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#ldepartment').hide();
                    $('#department').hide();
                    $('#ladddistrict').hide();
                    $('#adddistrict').hide();
                    $('#laddarea').hide();
                    $('#addarea').hide();
                    $('#laddbranch').hide();
                    $('#addbranch').hide();
                    $('#laddposition').hide();
                    $('#addposition').hide();
                    $('#addpositions').show();
                    $('#addeverpositions').hide();
                }

                $('#addprojectline').val(vals);
        })
            //DISTRICT OPTION
                $('#adddistrict').on('change', function(){
                var a = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('area')}}',
                    data: {'district': a},
                    success: function(response){
                        $('#addarea').attr('disabled', false);
                        $('#addarea').empty();

                        $('#addbranch').empty();
                        $('#addarea').append('<option value="" selected="selected" disabled>Area List</option>')
                        $.each(response, function(index, data) {
                            $('#addarea').append('<option value="'+data.area_code+'">'+data.area_no+'</option>')
                        });
                },
                })
                })
                //Area Option
                $('#addarea').on('change', function(){
                var area = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('branch')}}',
                    data:{'area_code':area},
                    success:function(response){
                        $('#addbranch').attr('disabled',false);
                        $('#addbranch').empty();
                        $('#addbranch').append('<option value="" selected="selected" disabled>Branch List</option>')
                        $.each(response, function(index, data) {
                            $('#addbranch').append('<option value="'+data.branch_code+'">'+data.branch_loc+'</option>')
                        });
                    }

                })
            })
            $('input[name=addprojectlines]').on('change',function(){
                var pl = $(this).val();
        
                if(pl == 'OperationManager'){
                    $('#addEmpid').attr('disabled', false);
                    $('#laddteam').show();
                    $('#addteam').show();
                    $('#addName').attr('disabled', false);
                    $('#addOIC').hide();
                    $('#laddOIC').hide();
                    $('#addProjectManager').hide();
                    $('#laddProjectManager').hide();
                }else if (pl == 'ProjectManager'){
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#laddteam').show();
                    $('#addteam').show();
                    $('#addOIC').show();
                    $('#laddOIC').show();
                    $('#addProjectManager').hide();
                    $('#laddProjectManager').hide();
                }else if (pl == 'ProjectEngineer'){
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#laddteam').show();
                    $('#addteam').show();
                    $('#addOIC').show();
                    $('#laddOIC').show();
                    $('#addProjectManager').show();
                    $('#laddProjectManager').show();
                }
                $('#branchlineval').val(pl);

                $('#addteam').on('change', function(){
                var team = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('oic')}}',
                    data:   {'teamid': team},
                    success:function(response){
                        $('#addOIC').attr('disabled', false);
                        $('#addOIC').empty();
                        $('#addProjectManager').empty();
                        $('#addOIC').append('<option value="" selected="selected" disabled>OIC List</option>')
                        $.each(response, function(index, data) {
                        $('#addOIC').append('<option value="'+data.id+'">'+ data.name+'</option>')
                        });
                    }
                })
            })
            $('#addOIC').on('change', function(){
                var oic = $(this).val();
                $.ajax({
                    type:   'GET',
                    url:    '{{route('pm')}}',
                    data:   {'oicid':oic},
                    success:function(response){
                        $('#addProjectManager').attr('disabled', false);
                        $('#addProjectManager').empty();
                        $('#addProjectManager').append('<option value="" selected="selected" disabled>Project Manager List</option>')
                        $.each(response, function(index, data) {
                        $('#addProjectManager').append('<option value="'+data.id+'">'+ data.name+'</option>')
                        });
                    }
                })
            })
            })



            $('#useremployee').on('change', function(){
                var unregister = $(this).val();
            
                $.ajax({
                    type: 'GET',
                    url: '{{route('unregistered')}}',
                    data: {'empid':unregister},
                    success:function(response){
                        $('#NameUser').val(response.employeename);
                    }

                })

            })
            setTimeout(() => {
                var latecount = $('#latecount').html();
                var earlycount = $('#earlyoutcount').html();
                var presentcount = $('#presentcount').html();
                var absentcount = $('#absentscount').val();
     
    
    // var chart = new CanvasJS.Chart("chartContainer", {
    //     animationEnabled: true,
    //     title: {
    //         text: "Attendance Performance Report"
    //     },
    //     data: [{
    //         type: "pie",
    //         startAngle: 240,
    //         yValueFormatString: "##0\"\"",
    //         indexLabel: "{label} {y}",
    //         dataPoints: [
    //             {y: 1, label: "Absent"},
    //             {y: latecount, label: "Late"},
    //             {y: earlycount, label: "Early Out"},
    //             {y: presentcount, label: "On Time"},
 
    //         ]
    //     }]
    // });
    // chart.render();

    var ctx = $("#chart-line");
        var myLineChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Absent", "Early Out", "Late", "Present"],
                datasets: [{
                    data: [absentcount, earlycount, latecount, presentcount],
                    backgroundColor: ["rgba(217, 30, 24, 1)", "rgba(249, 105, 14, 1)", "rgba(255, 240, 0, 1)", "rgba(0, 230, 64)"],
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Attendance Performance Report'
                }
            }, series: [
        {
            dataLabel: {
                visible: true,
            },
        }
    ],




            
        });



                    }, 2000);

            
            // End of document ready function
            });


            $('#adddepartmentform').on('submit', function(e){
                e.preventDefault();
                var data = $('#adddepartmentform').serializeArray();

                $.ajax({
                    type: 'POST',
                    url: '{{route('adddepartmentfunction')}}',
                    data: data,
                    success:function(response){
                        Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1000

                    })

                    $('#adddepartmentmodal').modal('hide');
                    setTimeout(() => {
                    location.reload(); 
                    }, 3000);

                    }
                })
            })

//             $('#syncform').on('submit', function(e){
//                 e.preventDefault();
//                 $.ajax({
//                 type: 'GET',
//                 url: '#',
//                 success:function(response){
//                       Swal.fire({
//                       icon: 'success',
//                       title: 'Your work has been saved',
//                       showConfirmButton: false,
//                       timer: 2000
//                       })
//                       $('#syncingmodal').modal('hide');
//   }
// })

// })

      

            $('#addpositionsform').on('submit', function(e){
                e.preventDefault();
                var data = $('#addpositionsform').serializeArray();
                
                $.ajax({
                    type: 'POST',
                    url: '{{route('addpositionsfunction')}}',
                    data: data,
                    success:function(response){
                        Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 2000

                    })

                    $('#addpositionsmodal').modal('hide');
                    setTimeout(() => {
                    location.reload(); 
                    }, 2100);
                    }
                })
            })
            

            // $('#syncform').on('submit', function(){
                
            //     $.ajax({
            //         type: 'GET',
            //         url: '#',
            //         success:function(response){
                        
            //         }

            //     })


            // })


        function addteammodal(){
            $('#addteammodal').modal('show');
            $.ajax({
            type:   'GET',
            url:    '{{route('addmaxteamid')}}',
            success:function(response){
            var maxid = response.id;
            $('#team_iddisplay').val(maxid);
            $('#team_id').val(maxid);
            }
            })
        }



        function addtimelimitmodal(){
            $('#addtimelimitmodal').modal('show');

        }

        function addcompanymodal(){
            $('#addcompanymodal').modal('show');
            $.ajax({
                type: 'GET',
                url: '{{route('addmaxcompanyid')}}',
                success:function(response){

                    var maxid = response.id + 1;
                    console.log(maxid);
                    $('#company_iddisplay').val(maxid);
                    $('#company_id').val(maxid);
                }
            })
        }

        // $('#addcompanyclicker').on('click', function(){
        //     $('#addcompanymodal').modal('show');
        //     $.ajax({
        //         type: 'GET',
        //         url: '{{route('addmaxcompanyid')}}',
        //         success:function(response){

        //             var maxid = response.id + 1;
        //             console.log(maxid);
        //             $('#company_iddisplay').val(maxid);
        //             $('#company_id').val(maxid);
        //         }
        //     })
        // })

        function adddepartmentmodal(){
            $('#adddepartmentmodal').modal('show');
            $.ajax({
                type: 'GET',
                url: '{{route('addmaxdepartmentid')}}',
                success:function(response){
                    var maxid = response.id + 1;
                   
                    $('#department_iddisplay').val(maxid);
                    $('#department_id').val(maxid);
                }
            })
        }

        function addengineersmodal(){
            $('#addengineersmodal').modal('show');
        }

        $('#addengineersmodal').on('hidden.bs.modal', function (e) {
            console.log($('#addempform'))
            alert('hell')    
        })

        function addpositionsmodal(){
            $('#addpositionsmodal').modal('show');
            $.ajax({
                type: 'GET',
                url: '{{route('addmaxpositionsid')}}',
                success:function(response){
                    var maxid = response.id + 1;
                    $('#positions_iddisplay').val(maxid);
                    $('#positions_id').val(maxid);
                }
            })
        }

        function addusersmodal(){
        $('#addusersmodal').modal('show');

        }


        function syncingcount(f_data){
        data = f_data;
    
        $.ajax({
            type: 'GET',
            url: '/userssyncingfunction',
            data: {'req' : data},
            success:function(response){
            $('#cusercounts').val(response);
            }
        });
        }

        function userscount(){
            $.ajax({
                type:'GET',
                url: '/userscount',
                success:function(response){
                $('#localusercount').val(response);
                }
            });
        }




    
        </script>
        @endsection


