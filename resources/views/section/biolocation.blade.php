@extends('template.main')

@section('content')


        <div class="container mt-5">
            <h2 class="mb-4">Biometrics Location List 
                
                @if(Auth::user()->role == 2)
                @php
                if(!$sock = @fsockopen('www.google.com', 80))
                {
                    //Youre not connected in the internet
                }
                else
                {
                @endphp
                    <button type="submit" class="btn btn-success" name="syncingbio" id="syncingbio" style="margin-left:45%;">Sync the biometrics to cloud</button>
                @php
                }
                @endphp
                @endif
                
              

            </h2>
            <h5>Biometrics Serial Number: 
                @if ($bioserial == "0") 
                <span style='color:red;'>No Biomterics Connected</span>
                @else {{$bioserial}}  @endif</h5>
            

            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="biolocdisplay">
                <thead>
                    <tr>
                        <th>Biometrics ID</th>
                        <th>Serial Number</th>
                        <th>Biometrics Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        </div>
           
        

@endsection

@section('script') 
<script>
   $(document).ready(function(){
 $('#biolocdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('biolocdisplay')}}',
        columns: [
            {data: 'id'},
            {data: 'serialno'},
            {data: 'location'},
            {data: 'action'},
            
       
           
          
        ]
    });
})

 $('#syncingbio').on('click', function(e){
            e.preventDefault();

        window.open('https://www.acs.multi-linegroupofcompanies.com/samplebiolocation');

            // $.get("https://www.acs.multi-linegroupofcompanies.com/biotocloud", function( data ) {
            //     // getdata = data;  
            //     ajaxCloud(data);
            //     })
    //         $.ajax({
    //             type: 'GET',
    //             url: '{{ route('syncbio') }}',
    //             success: function(response) {
    //                 alert('success')
    //             }
    //         });
    // })
    //     function ajaxCloud(f_data) {
    //     //     for(i = 0;i<5;i++){
    //     //         test = f_data[i].id;
    //     //         console.log(test)
    //     //     }
    //     //    return;
    //         data = f_data;
    //         $.ajax({
    //             type: 'GET',
    //             url: '/userscloudfunction',
    //             data: {'req' : data},
    //             success:function(response){
    //                 $('#syncingmodal').modal('hide');
    //                 Swal.fire({
    //                   icon: 'success',
    //                   title: 'Your work has been saved',
    //                   showConfirmButton: false,
    //                   timer: 2000
    //             })
    //         }
    //         });
    //     }
    })  
    </script>
@endsection