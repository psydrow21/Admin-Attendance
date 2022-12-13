<!-- Modal -->
<div class="modal fade" id="editcompanymodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

        <form id="editemploy">
       @csrf
        <div class="form-group form-primary">
        <label class="float-label">Employee ID</label>
        <input type="text"  name="emp_idplay" id="emp_idplay" class="form-control" readonly>
        <input type="text"  name="emp_id" id="emp_id" class="form-control" hidden>
        <span class="form-bar"></span>
        <label class="float-label">Name</label>
        <input type="text" name="names" id="names" class="form-control">
        <span class="form-bar"></span>
        <label class="float-label">Logs</label>
        <input type="text" name="logs" id="logs" class="form-control">
        <span class="form-bar"></span>
        <label class="float-label">Status</label>
        <input type="text" name="status" id="status" class="form-control">
        <span class="form-bar"></span>
        <label class="float-label">Type</label>
        <input type="text" name="types" id="types" class="form-control">
        <span class="form-bar"></span>
        
       
       

         </div>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-success" name="edit" id="edit">Edit Employee</button>
      </form>
      </div>
     </div>
  </div>
</div>
