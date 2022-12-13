@extends('template.main')

@section('content')
@include('modal.EditCompanyModal')

        <div class="container mt-5">
            <h2 class="mb-4">Company List</h2>
            <div class ="data-tables datatable-dark">
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
    
    $('#editcompanyform').on('submit', function(e){
        e.preventDefault();
        data = $('#editcompanyform').serializeArray();

        $.ajax({
            type:'GET',
            url: '{{route('editcompanyfunction')}}',
            data: data,
            success:function(response){
                $('#editcompanymodal').modal('hide');
              

                $('#companydisplay').DataTable({
            orderable: true, 
            searchable: true,
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: '{{route('companydisplay')}}',
            columns: [
            {data: 'company_id'},
            {data: 'company_name'},
            {data: 'action',
            },
       
           
          
        ]
    });
            }
        })


    })
    
    function editcompanymodal(id,name){
        $('#editcompanymodal').modal('show');
        $('#editcompany_iddisplay').val(id);
        $('#editcompany_id').val(id);
        $('#editcompanyname').val(name);


        var editcompany_id = $('#editcompany_id').val();
        console.log(editcompany_id)
        $.ajax({
            type: 'GET',
            url: '{{route('editcompanyfetch')}}',
            data: editcompany_id,
            success:function(response){
                console.log(response.company_name);
          
            }
        })
    }



    </script>

    @endsection