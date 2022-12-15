@extends('template.main')

@section('content')


        <div class="container mt-5">
            <h2 class="mb-4">Department List</h2>
            <table class="table table-bordered yajra-datatable" id="companydisplay">
                <thead>
                    <tr>
                        <th>Company ID</th>
                        <th>Company Name</th>
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
 $('#companydisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('companydisplay')}}',
        columns: [
            {data: 'company_id'},
            {data: 'company_name'},
            {data: 'action',
            },
       
           
          
        ]
    });


    })  
    </script>
@endsection