@extends('template.main')

@section('content')

<br>
<form id = "payrollfilter">
    {{-- <strong style="margin-left:15%;">Location :</strong>
    <select name="locationfilter" id="locationfilter">
        <option value="" selected="selected" disabled></option>
    @foreach ($locationfilter as $item)
        <option value="{{$item->serialno}}">{{$item->location}}</option>
    @endforeach
    </select> --}}

    <strong style="margin-left:15%;">Filter By :</strong>
    <select name="lastfilter" id="lastfilter">
        <option value="" selected="selected" disabled></option>
        <option value="Today">Today</option>
        <option value="Yesterday">Yesterday</option>
        <option value="Last15">Last 15 Days</option>
        <option value="LastMonth">Last Month</option>
    </select>


    <strong style="margin-left:2.5%;">Date Range:</strong>
    <input type="date"  id="fromDate" name="fromDate">
    <strong>-</strong>
    <input type="date" id="toDate" name="toDate">

    
 

    <button style="margin-left:2.5%;" type="submit" class="btn btn-primary">Filter</button>
    <button  type="button" class="btn btn-danger" name="clearfilter" id="clearfilter">Reset Filter</button>
    {{-- <a href="{{route('exportlogs')}}"  class="btn btn-success" id="export" name="export"><i class="ti-export"></i> Exporting File</a> --}}
</form>

{{-- <livewire:export-button :table-id="$dataTable->payrolldisplay()" /> --}}


        <div class="container mt-5">
            <h2 class="mb-4">Payroll Format(Cloud Server)</h2>
            <div class ="data-tables datatable-dark">
                <table class="table table-bordered yajra-datatable" id="payrolldisplay">
                    <thead>
                        <tr>
                            <th>Employee Id</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>            
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
    $('#payrolldisplay').DataTable();


    // $('#payrolldisplay').DataTable({
      

    //     orderable: true, 
    //     searchable: true,
    //     processing: true,
    //     serverSide: true,
    
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'excel'
    //     ],
     

     
    
    //     ajax: '{{route('payrollformatdisplay')}}',
    //     columns: [
    //         {data: 'empid'},
    //         {data: 'type'},
    //         {data: 'logs'},  
    //     ]
    // });
     $('#payrollfilter').on('submit', function(e){
        e.preventDefault();

        data = $('#payrollfilter').serializeArray();
            var datefrom = $('#fromDate').val();
            var dateto = $('#toDate').val();
            var lastfilter = $('#lastfilter').val();
            var location = $('#locationfilter').val();
    
            if(datefrom == "" && dateto == "" && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Select Filter to show the data',
                        })
                 return;
            }else if (datefrom == "" && dateto != "" && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly:',
                        })
                 return;

            }
            else if(datefrom >= dateto && lastfilter == null && location == null){
                Swal.fire({
                        icon: 'error',
                        text: 'Invalid input of Date To:',
                        })
                        $('#toDate').val('');
                        return;
            }

            else if(datefrom != "" && dateto == "" && lastfilter == null && location != null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly: (Location Selected)',
                        })
                 return;
            }
            
            else if (datefrom == "" && dateto != "" && lastfilter == null && location != null){
                Swal.fire({
                        icon: 'error',
                        text: 'To Filter Must Select a Date Range Properly: (Location Selected)',
                        })
                 return;

            }
           


        $('#payrolldisplay').DataTable({
            paging: false,
       
            "oTableTools": {
            "aButtons": [
            {
            "sExtends": "text",
            "sButtonText": "Hello world"
            }
            ],
            },
            dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
            
        ],
        buttons: [{
        
         
        header: false,
        extend: 'excel',
        title: null,
        convert: 'txt'
        }],
                orderable: true, 
                searchable: true,
                processing: true,
                destroy: true,
                serverSide: true,
                
                ajax: {
                    type: 'GET',
                    data: {'from':$('#fromDate').val() , 'to':$('#toDate').val(), 'filter':$('#lastfilter').val(), 'location':$('#locationfilter').val() },
                    url : '{{route('payrollfilter')}}'
                },
                columns: [
                    {data: 'empid', searchable: true},
                    {data: 'type'}, 
                    {data: 'date'},
                    {data: 'time'},
                    
                 ]
            });
            

    })

    $('#lastfilter').on('change',function(){
        $('#fromDate').val('');
        $('#toDate').val('');
    })

    $('#fromDate').on('change', function(){
        $('#lastfilter').val('');
    })

    $('#toDate').on('change', function(){
        $('#lastfilter').val('');
    })

 
    $('#clearfilter').on('click',function(){
        $('#fromDate').val('');
        $('#toDate').val('');
        $('#lastfilter').val('');
        $('#locationfilter').val('');

        $('#payrolldisplay').DataTable().clear();
        $('#payrolldisplay').DataTable({
                    destroy:true,   
                });
       


    })
    
})
    </script>
@endsection