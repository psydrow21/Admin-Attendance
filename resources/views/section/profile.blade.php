@extends('template.main')

@section('content')

<style>
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}
.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}
.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}
.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}
.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}
.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}
.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}
.account-settings .about p {
    font-size: 0.825rem;
}
.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}</style>


        
<div class="container">
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar">
                        &nbsp&nbsp &nbsp&nbsp<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                    </div>
                    <h5 class="user-name" id="user-name"></h5>
                    <h6 class="user-email" id="user-email"></h6>
                </div>
                {{-- Additional Details --}}
                <div class="about">
                    <h5>About</h5>
                    <p>Masipag na nilalang</p>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">User Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="user-fullname" placeholder="Enter full name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail">Email</label>
                        <input type="email" class="form-control" id="user-fullemail" placeholder="Enter email ID">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Username</label>
                        <input type="text" class="form-control" id="user-username" placeholder="Username">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="website">Password</label>
                        <input type="url" class="form-control" id="user-password" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Employee Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">

                        <label class="float-label">Employee ID</label>
                        <input type="text" name="user-empid" id="user-empid" class="form-control" disabled>
                         <span class="form-bar"></span>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="float-label" id="laddcompany">Company</label>
                        <select class="form-control" name="user-company" id="user-company">
                          <option value="" disabled>Company List</option>
                        @foreach ($companyread as $ckey)
                        <option value="{{ $ckey->company_id }}"> {{ $ckey->company_name }}</option>
                        @endforeach
                        </select>
            
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="float-label" id="ldepartment">Department</label>
                        <select class="form-control" name="user-department" id="user-department">
                          <option selected="selected" value="" disabled>Department List</option>
                        @foreach ($department as $dpkey)
                        <option value="{{ $dpkey->id }}"> {{ $dpkey->department_name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="float-label" id="lpositions">Position</label>
                        <select class="form-control" name="user-positions" id="user-positions">
                          <option selected="selected" value="" disabled>Position List</option>
              
                        @foreach ($departmentposition as $poskey)
                        <option value="{{ $poskey->id }}"> {{ $poskey->position_name }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                        <button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
    $(document).ready(function(){

        $.ajax({
            type: 'GET',
            url: '{{route('profiledisplay')}}',
            success:function(response){
                $('#user-name').html(response.name);
                $('#user-email').html(response.email);

                $('#user-fullname').val(response.name);
                $('#user-fullemail').val(response.email);
                $('#user-username').val(response.username);
                $('#user-password').val(response.password);
                $('#user-empid').val(response.empid);


                $('#user-company:selected').text(response.companyid);
          
            }
        })



    })
    

</script>

@endsection