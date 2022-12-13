





<!-- Modal -->
<div class="modal fade" id="adddepartmentmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Add New Department</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="adddepartmentform">
      @csrf
      <div class="form-group form-primary">
        <label class="float-label">Department Id</label>

        <input type="text" name="department_iddisplay" id="department_iddisplay" class="form-control" readonly>

        <input type="text" name="department_id" id="department_id" class="form-control" hidden>

        <span class="form-bar"></span>

        <div class="form-group form-primary">
        <label class="float-label">Department Name</label>
        <input type="text" name="adddepartmentname" id="adddepartmentname" class="form-control" >
        <span class="form-bar"></span>
        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Add New Department</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





