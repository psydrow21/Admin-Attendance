





<!-- Modal -->
<div class="modal fade" id="addpositionsmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Add New Position</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="addpositionsform">
      @csrf
      <div class="form-group form-primary">
        <label class="float-label">Position Id</label>

        <input type="text" name="positions_iddisplay" id="positions_iddisplay" class="form-control" readonly>

        <input type="text" name="positions_id" id="positions_id" class="form-control" hidden>

        <span class="form-bar"></span>

        <label class="float-label" id="lpositiondepartment" >Department</label>
          <select class="form-control" name="positiondepartment" id="positiondepartment" >
            <option selected="selected" value="" disabled>Department List</option>
          @foreach ($department as $dpkey)
          <option value="{{ $dpkey->id }}"> {{ $dpkey->department_name }}</option>
          @endforeach
          </select>

        <div class="form-group form-primary">
        <label class="float-label">Position Name</label>
        <input type="text" name="addpositionsname" id="addpositionsname" class="form-control" >
        <span class="form-bar"></span>
        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Add New Position</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





