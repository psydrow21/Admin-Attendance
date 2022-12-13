

<!-- // ADD NEW EMPLOYEE MODAL -->




<!-- Modal -->
<div class="modal fade" id="editdepartmentmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="editdepartmentform">
      @csrf
      <div class="form-group form-primary">
        <label class="float-label">Department Id</label>

        <input type="text" name="editdepartment_iddisplay" id="editdepartment_iddisplay" class="form-control" readonly>
        <span class="form-bar"></span>

        <div class="form-group form-primary">
        <label class="float-label">Department Name</label>
        <input type="text" name="editdepartmentname" id="editdepartmentname" class="form-control" >
        <span class="form-bar"></span>
        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Edit Department</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





