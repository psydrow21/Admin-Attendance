@extends('template.main')

@section('content')


        <div class="container mt-5">
            <h2 class="mb-4">Department List</h2>
            <table class="table table-bordered yajra-datatable" id="teamdisplay">
                <thead>
                    <tr>
                        <th>Department ID</th>
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
 $('#teamdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('teamdisplay')}}',
        columns: [
            {data: 'id'},
            {data: 'teamname'},
            {data: 'action',
            },
       
           
          
        ]
    });


    })  
    </script>
@endsection