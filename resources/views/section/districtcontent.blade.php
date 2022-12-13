@extends('template.main')

@section('content')



        <div class="container mt-5">
            <h2 class="mb-4">Company List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="districtdisplay">
                <thead>
                    <tr>
                        <th>District Number</th>
                        <th>Under By Name</th>
                        <th>Company Name</th>
             
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
 $('#districtdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('district')}}',
        columns: [
            {data: 'district_number'},
            {data: 'district_name'},
            {data: 'company_id'},
        
       
           
          
        ]
    });


    })  
    </script>
@endsection