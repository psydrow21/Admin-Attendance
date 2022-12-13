@extends('template.main')

@section('content')



        <div class="container mt-5">
            <h2 class="mb-4">Branch List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="branchdisplay">
                <thead>
                    <tr>
                        <th>Branch Code</th>
                        <th>Branch Location</th>
                        <th>Branch Head</th>
                        <th>District Code</th>
                        <th>Area Code</th>
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
 $('#branchdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('branchdisplay')}}',
        columns: [
            {data: 'branch_code'},
            {data: 'branch_loc'},
            {data: 'branch_head'},
            {data: 'district_code'},
            {data: 'area_code'},
            {data: 'company_id'},
          
        ]
    });


    })  
    </script>
@endsection