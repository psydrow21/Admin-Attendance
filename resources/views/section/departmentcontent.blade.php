@extends('template.main')

@section('content')

@include('modal.EditDepartmentModal')

        <div class="container mt-5">
            <h2 class="mb-4">Department List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="departmentdisplay">
                <thead>
                    <tr>
                        <th>Department ID</th>
                        <th>Department Name</th>
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
 $('#departmentdisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('departmentdisplay')}}',
        columns: [
            {data: 'id'},
            {data: 'department_name'},
            {data: 'action'},
            
       
           
          
        ]
    });


    })
    
    $('#editdepartmentform').on('submit', function(e){
        e.preventDefault();
        data = $('#editdepartmentform').serializeArray();

        $.ajax({
            type: 'GET',
            url: '{{route('editdepartmentfunction')}}',
            data: data,
            success:function(response){
            $('#editdepartmentmodal').modal('hide');

            $('#departmentdisplay').DataTable({
            orderable: true, 
            searchable: true,
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: '{{route('departmentdisplay')}}',
            columns: [
            {data: 'id'},
            {data: 'department_name'},
            {data: 'action'},
        ]
    });
            }
        })
    })
    </script>
    <script>
        function editdepartmentmodals(id,name){
            $('#editdepartmentmodal').modal('show');
            $('#editdepartment_iddisplay').val(id);
            $('#editdepartmentname').val(name);
        }
    </script>
@endsection