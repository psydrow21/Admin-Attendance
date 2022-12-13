@extends('template.main')

@section('content')

@include('modal.EditBioLocationModal')


        <div class="container mt-5">
            <h2 class="mb-4">Biometrics Location List</h2>
            <div class ="data-tables datatable-dark">
            <table class="table table-bordered yajra-datatable" id="biolocalldisplay">
                <thead>
                    <tr>
                        <th>Biometrics ID</th>
                        <th>Serial Number</th>
                        <th>Biometrics Location</th>
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
 $('#biolocalldisplay').DataTable({
        orderable: true, 
        searchable: true,
        processing: true,
        serverSide: true,
        ajax: '{{route('biolocalldisplay')}}',
        columns: [
            {data: 'id'},
            {data: 'serialno'},
            {data: 'location'},
            {data: 'action'},
        ]
    });





    })  

    $('#editbiolocform').on('submit', function(e){
        e.preventDefault();
        data = $('#editbiolocform').serializeArray();

        $.ajax({
            type: 'GET',
            url: '{{route('editbiolocfunction')}}',
            data: data,
            success:function(response){
                $('#editbiolocmodal').modal('hide');

                $('#biolocalldisplay').DataTable({
                orderable: true, 
                searchable: true,
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: '{{route('biolocalldisplay')}}',
                columns: [
                {data: 'id'},
                {data: 'serialno'},
                {data: 'location'},
                {data: 'action'},
                ]
            });

            }

        })
    });
    </script>
    <script>   
    function editbiolocmodals(id,serial,locations){
   
        $('#editbiolocmodal').modal('show');
        $('#editbioloc_iddisplay').val(id);
        $('#editbiolocserial').val(serial);
        $('#editbiolocname').val(locations);
    }
        </script>
@endsection