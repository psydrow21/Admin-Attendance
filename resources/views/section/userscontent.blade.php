@extends('template.main')

@section('content')


        <div class="container mt-5">
            <h2 class="mb-4">User List :   
                @if(Auth::user()->role == 1)
                All
                @elseif(Auth::user()->role == 2)
                {{$locationdisplay->location}}
                @endif</h2>
          
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="usersdisplay">
                <thead>
                    <tr>

                        <th>Employee ID</th>
                        @if(Auth::user()->role == 1)
                        <th>Location</th>
                        @endif
                        <th>User Role</th>
                        <th>Company</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
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


    
      
    @if(Auth::user()->role == 1)
        $('#usersdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('cloudusersdisplay')}}',
        columns: [
            {data: 'empid'},
            {data: 'bioloc_id'},
            {data: 'role'},
            {data: 'company_id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'username'},
            {data: 'password'},
            {data: 'action'},
            
        ]
    });
    

    @elseif(Auth::user()->role == 2){
        $('#usersdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('usersdisplay')}}',
        columns: [
            {data: 'empid'},
            {data: 'role'},
            {data: 'company_id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'username'},
            {data: 'password'},
            {data: 'action'},
            
       
           
          
        ]
    });

    }


    @endif
    })  
    </script>
@endsection