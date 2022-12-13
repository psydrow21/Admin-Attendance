@extends('template.main')

@section('content')


        <div class="container mt-5">
            <h2 class="mb-4">Position List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="posdisplay">
                <thead>
                    <tr>
                        <th>Position ID</th>
                        <th>Under By:(Department)</th>
                        <th>Position Name</th>
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
 $('#posdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('posdisplay')}}',
        columns: [
            {data: 'id'},
            {data: 'department_id'},
            {data: 'position_name'},
            {data: 'action'},
            
       
           
          
        ]
    });


    })  
    </script>
@endsection