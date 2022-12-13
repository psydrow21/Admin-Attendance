@extends('template.main')

@section('content')



        <div class="container mt-5">
            <h2 class="mb-4">Area List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="areadisplay">
                <thead>
                    <tr>
                        <th>Area Code</th>
                        <th>Area Number</th>
                        <th>Under By(Area)</th>
                        <th>District Code</th>
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
 $('#areadisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('areadisplay')}}',
        columns: [
            {data: 'area_code'},
            {data: 'area_no'},
            {data: 'area_name'},
            {data: 'district_code'},
            {data: 'company_id'},
         
        ]
    });


    })  
    </script>
@endsection