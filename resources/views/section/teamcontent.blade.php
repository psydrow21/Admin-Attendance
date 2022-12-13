@extends('template.main')

@section('content')





        <div class="container mt-5">
            <h2 class="mb-4">Operation Manager</h2>
            <table class="table table-bordered yajra-datatable" id="tableoperation">
                <thead>
                    <tr>
                        <th>Operation Manager ID</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
           
        

@endsection

@section('script') 
<script>
   $(document).ready(function(){
 $('#tableoperation').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('operationmanager')}}',
        columns: [
            {data: 'id'},
            {data: 'empid'},
            {data: 'name'},
            {data: 'teamid'}, 
            {data: 'action'},
       
           
          
        ]
    });


    })  
    </script>
@endsection