
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
            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
         
 <!-- NAME INSERT HERE-->             <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <?php echo $logname;?> <i class="fa fa-angle-down"></i></h4>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Message</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" id="logout" href="logout.php">Log Out</a>
            </div>
        </div>
        <?php echo "<span style='color:red;font-weight:bold;'>Date: </span>".$date_now; ?>
    </div>
</div>
</div>