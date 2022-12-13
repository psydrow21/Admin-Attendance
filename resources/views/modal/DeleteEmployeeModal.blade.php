<!-- Modal -->
<div class="modal fade" id="deletemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="deleteformemployee">
       @csrf
        <div class="form-group form-primary">
       
        <input hidden type="text" name="emp_deleteid" id="emp_deleteid" class="form-control">
       
    
       <h2>Are you sure you want to delete this employee?</h2>

         </div>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-danger" name="deletes" id="deletes">Yes</button>
   
        </form>     
        <button type="button" class="btn btn-secondary" name="return" id="return">No</button>
      </div>
     </div>

  </div>
</div>
