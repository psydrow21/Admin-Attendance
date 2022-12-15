@extends('template.main')

@section('content')


@include('modal.AddProjectEmployee')
@include('modal.AddTeamModal')
@include('modal.AddTimeLimitModal')
@include('modal.AddCompanyModal')

        <div class="sales-report-area mt-5 mb-5">
            <div class="row">
                <div class="col-md-4" >
                    <div class="single-report mb-xs-30" style="background-color:white;">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                            
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Company Count</h4>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <h2 name="companycount" id="companycount">
                                        </h2>
                            
                            </div>
                        </div>
                    
                        <img src="{{asset('assets/images/svg/building.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <div class="s-report-inner pr--20 pt--30 mb-3">
                        
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Branches</h4>
                    
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                            <h2 class="branchescount"></h2>
                        
                            </div>
                        </div>
                        <img src="{{asset('assets/images/svg/union.svg')}}" style="width:33%;margin-left:38%;">
                    </div>
                </div>

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
            </div>
        </div>


        <!-- sales report area end -->
        <!-- overview area start -->
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">Overview</h4>
                            <select class="custome-select border-0 pr-3">
                                <option selected>Last 24 Hours</option>
                                <option value="0">01 July 2018</option>
                            </select>
                        </div>
        
                        <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_hlzxxlfs.json"  background="transparent"  speed="1"  style="width: 100%; height: 400px;"  loop autoplay></lottie-player> </div>
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
        <div class="container mt-5">
            <form id = "attendancefilter">
            <h2 class="mb-4">Attendance Logs</h2>

            <strong style="margin-left:10%;">Date From:</strong>
            <input type="date"  id="fromDate" name="fromDate">
            <strong style="margin-left:10%;" >Date To:</strong>
            <input type="date" id="toDate" name="toDate">
            <button style="margin-left:10%;" type="submit" class="btn btn-primary">Filter</button>
            <br></br>
            </form>

            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Date</th>
                        <th>Time</th> 
                        <th>Status</th>
                        <th>Type</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
                $('#adddistrict').hide();
                $('#addarea').hide();
                $('#addbranch').hide();
                $('#ladddistrict').hide();
                $('#laddarea').hide();
                $('#laddbranch').hide();
                $('#adddistrict').val('');
                $('#addarea').val('');
                $('#addbranch').val('');

                //Add new Employee Head Office Cleared And Hide
                $('#laddposition').hide();
                $('#addposition').hide();
                $('#addposition').val('');  
            }
        </script>

        <script>
        $(document).ready(function () {


            Swal.fire({
        title: 'Custom width, padding, color, background.',
        width: 600,

        padding: '3em',
        color: '#716add',
        background: '#fff url(/images/logo/think.gif)',
        backdrop: `
            rgba(0,0,123,0.4)
            url({{asset('assets/images/logo/think.gif')}})
            center top
            no-repeat
        `
        })

        $('#attendancefilter').on('submit', function(e){
          e.preventDefault();
          
            data = $('#attendancefilter').serializeArray();
            var datefrom = $('#fromDate').val();
            var dateto = $('#toDate').val();
            if(datefrom >= dateto){
                Swal.fire({
                        icon: 'error',
                        text: 'Invalid input of Date To:',
                        })
                        $('#toDate').val('');
                        return;
            }


            $('.yajra-datatable').DataTable({
                orderable: true, 
                searchable: true,
                processing: true,
                destroy: true,
                serverSide: true,
                ajax: {
                    type: 'GET',
                    data: {'from':$('#fromDate').val() , 'to':$('#toDate').val() },
                    url : '{{route('attendancefilter')}}'
                },
                columns: [
                    {data: 'empid'},
                    {data: 'date'}, 
                    {data: 'time'},
                    {data: 'status'},
                    {data: 'type'},
                    {data: 'state'}, 
                ]
            });
        })


            $.ajax({
                type: 'GET',
                url: '{{route('userscount')}}',
                success: function(response){
                    $('#userscount').html(response);
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


            $('.yajra-datatable').DataTable({
                orderable: true, 
                searchable: true,
                processing: true,
                serverSide: true,
                ajax: '{{route('fetchspecific')}}',
                
                columns: [
                    {data: 'empid'},
                    {data: 'date'}, 
                    {data: 'time'},
                    {data: 'status'},
                    {data: 'type'},
                    {data: 'state'}, 
                ]
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
                    
                    
                        loader.close();
                        
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
            $('input[name=branchline]').on('change', function(){
                var val = $(this).val();
                document.getElementById('adduserform').reset();
                if(val == 'EverFirst') {
                    $('#useremployee').attr('disabled', false);
                    $('#NameUser').attr('disabled', false);
                    $('#EmailUser').attr('disabled', false);
                    $('#UsernameUser').attr('disabled', false);
                    $('#PasswordUser').attr('disabled', false);
                    $('#district').attr('disabled', false);

                    $('#NameUser').attr('disabled', false);
                    $('#NameUser').attr('disabled', false);

                    $('#ldistrict').show();
                    $('#district').show();
                    $('#larea').show();
                    $('#area').show();
                    $('#lbranch').show();
                    $('#branch').show();
                    $('#lposition').hide();
                    $('#position').hide();
                    $('#projectline').hide();
                    $('#lOIC').hide();
                    $('#lPM').hide();
                    $('#lteam').hide();
                    $('#OIC').hide();
                    $('#team').hide();
                    $('#ProjectManager').hide();
                }else if(val == 'HeadOffice')
                {
                    $('#useremployee').attr('disabled', false);
                    $('#NameUser').attr('disabled', false);
                    $('#EmailUser').attr('disabled', false);
                    $('#UsernameUser').attr('disabled', false);
                    $('#PasswordUser').attr('disabled', false);
                    $('#ldistrict').hide();
                    $('#district').hide();
                    $('#larea').hide();
                    $('#area').hide();
                    $('#lbranch').hide();
                    $('#branch').hide();
                    $('#projectline').hide();
                    $('#lOIC').hide();
                    $('#lPM').hide();
                    $('#lteam').hide();
                    $('#OIC').hide();
                    $('#team').hide();
                    $('#ProjectManager').hide();
                    $('#lposition').show();
                    $('#position').show();
                }else if(val == 'ProjectSite'){
                    $('#useremployee').attr('disabled', false);
                    $('#NameUser').attr('disabled', false);
                    $('#EmailUser').attr('disabled', false);
                    $('#UsernameUser').attr('disabled', false);
                    $('#PasswordUser').attr('disabled', false);
                    $('#ldistrict').hide();
                    $('#district').hide();
                    $('#larea').hide();
                    $('#area').hide();
                    $('#lbranch').hide();
                    $('#branch').hide();
                    $('#lposition').hide();
                    $('#position').hide();
                    $('#projectline').show();
                    $('#lOIC').show();
                    $('#lPM').show();
                    $('#lteam').show();
                    $('#OIC').show();
                    $('#team').show();
                    $('#ProjectManager').show();
                }

                $('input[name=branchlineval]').val(val);
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
                    $('#addEmpid').attr('disabled', false);
                    $('#addName').attr('disabled', false);
                    $('#adddistrict').attr('disabled', false);
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
                            $('#addarea').append('<option value="'+data.area_code+'">'+data.area_no+'-'+ data.area_name+'</option>')
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
                            $('#addbranch').append('<option value="'+data.branch_code+'">'+data.branch_loc+'-'+ data.branch_head+'</option>')
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
            // End of document ready function
            });
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

        function addengineersmodal(){
            $('#addengineersmodal').modal('show');
        }

        $('#addengineersmodal').on('hidden.bs.modal', function (e) {
            console.log($('#addempform'))
            alert('hell')    
        })


        function addusersmodal(){
        $('#addusersmodal').modal('show');

        }


        </script>
        @endsection


