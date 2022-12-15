
<div class="page-title-area">
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="breadcrumbs-area clearfix">
            <h4 class="page-title pull-left">Dashboard</h4>
            <ul class="breadcrumbs pull-left">
                <li><a href="index.html">Home</a></li>
                <li><span>Table</span></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-6 clearfix">
        <div class="user-profile pull-right">
            
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets4.lottiefiles.com/packages/lf20_C0QBH09bFB.json"  background="Transparent"  speed="1.5"  style="width: 75px; height: 75px;"  loop autoplay></lottie-player>
         
 <!-- NAME INSERT HERE-->    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name}} <i class="fa fa-angle-down"></i></h4>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Message</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" name="logout" id="logout"  href="{{ route('logout') }}">Log Out</a>
            </div>
        </div>
        
    </div>
</div>
</div>