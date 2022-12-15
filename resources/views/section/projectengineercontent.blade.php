@extends('template.main')

@section('content')



        <div class="container mt-5">
            <h2 class="mb-4">Team List</h2>
            <table class="table table-bordered yajra-datatable" id="engineerdisplay">
                <thead>
                    <tr>
                        <th>Project Engineer ID</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Under By - OIC</th>
                        <th>Project Manager/Supervisor</th>
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
 $('#engineerdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('engineer')}}',
        columns: [
            {data: 'id'},
            {data: 'empid'},
            {data: 'name'},
            {data: 'teamid'},
            {data: 'oicid'},
            {data: 'pmid'},
            {data: 'action',
            },
       
           
          
        ]
    });


    })  
    </script>
@endsection