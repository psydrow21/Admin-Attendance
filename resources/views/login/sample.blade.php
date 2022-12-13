<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    

   
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function () {
    

    var getdata = [];
  $.get( "https://www.acs.multi-linegroupofcompanies.com/userstocloud", function( data ) {
    // console.log(data);
    // getdata = data;  

    //insertion of cloud to local
    // ajaxCloud(data);

    //Counting the array
   syncingcount(data);

    })

  })


  function syncingcount(f_data){
    data = f_data;
  
    $.ajax({
        type: 'GET',
        url: '/userssyncingfunction',
        data: {'req' : data},
        success:function(response){
          
        }
    });
  }
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
          
        }
    });
}
</script>
</html>