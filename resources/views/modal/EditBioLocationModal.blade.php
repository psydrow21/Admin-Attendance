

<!-- // ADD NEW EMPLOYEE MODAL -->




<!-- Modal -->
<div class="modal fade" id="editbiolocmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Edit Biometrics Location</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="editbiolocform">
      @csrf
      <div class="form-group form-primary">
        <label class="float-label">Biometrics Location Id</label>

        <input type="text" name="editbioloc_iddisplay" id="editbioloc_iddisplay" class="form-control" readonly>

   
        <span class="form-bar"></span>

        <div class="form-group form-primary">
        <label class="float-label">Serial Number</label>
        <input type="text" name="editbiolocserial" id="editbiolocserial" class="form-control" >
        <span class="form-bar"></span>
        
        
        <label class="float-label">Location</label>
        <input type="text" name="editbiolocname" id="editbiolocname" class="form-control" >
        <span class="form-bar"></span>

         </div>


      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Edit Biometrics Location</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





