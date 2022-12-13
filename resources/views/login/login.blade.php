<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!--Sweet alert js -->
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js')}}"></script>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->


    <!-- INSERT REGISTER MODAL HERE -->
    {{-- @include('inc.registermodal') --}}
    
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
        
                <form action="{{route('authenticate')}}" method="POST" >
                    @csrf
                    <div class="login-form-head">

                  
                        <h4>Sign In</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" id="username" name="username">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        

                     
                        <div class="submit-btn-area">
                            <button id="login" type="submit">Submit</button>
                        </div>
                        
                        {{-- <iframe src="http://127.0.0.1:8000/userscontent" style="zoom: 0.75; -moz-transform: scale(0.75); -moz-transform-origin: 0 0;" frameborder="0"  width="100%" height="200px" style="border:1px solid black;">
                        </iframe> --}}
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted"><img src="assets/images/logo/logo2.gif">
</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
    
    <!-- others plugins -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
</body>

</html>

<script>
   


       // This button will be trigger when the add employee button in addmodal is clicked
       $('#register').on('click' , function(){
    // Setting the variable and getting the value of the input in the add modal
        var regname =      $('#regfullname').val(); 
        var regposition =   $('#regposition').val();
        var regusername =    $('#regusername').val();
        var regpass =    $('#regpass').val();

     
    // if else function is to validate the input in addmodal.php
        if(regname != "" && regposition != "" && regusername != "" && regpass != ""){
    // this ajax for the Query and getting the result of it.
            $.ajax({
    //url for the getting the query file
                url       : "partials/Register.php",   
    //type is the method of the ajax
                type      : "POST",
    //dataType to return the getting file into json
                dataType  : "json",
    //data: is for getting the addmodal input text and transfer the data in the url
                data : {
                    "name"      : regname,
                    "position"  : regposition,
                    "username"    : regusername,
                    "pass"      : regpass,             
                },
    // if the query is success and successfully return this function will triggered
                success: function(dataresult){
               
                $('#registermodals').modal('hide');

                $('#regfullname').val('');
                $('#regposition').val('');
                $('#regusername').val('');
                $('#regpass').val('');
                document.getElementById("regposition").disabled = true;
                document.getElementById("regusername").disabled = true;
                document.getElementById("regpass").disabled = true;
       
                }
            });
    // end if
 
           // Display the successfully changed
    //Notification Success
    swal("Registered successfully.", {
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
    });
  
    }
 
    // end of add button click in registermodal
    });




</script>