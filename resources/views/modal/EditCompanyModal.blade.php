

<!-- // ADD NEW EMPLOYEE MODAL -->




<!-- Modal -->
<div class="modal fade" id="editcompanymodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Edit Company</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="editcompanyform">
      @csrf
      <div class="form-group form-primary">
        <label class="float-label">Company Id</label>

        <input type="text" name="editcompany_iddisplay" id="editcompany_iddisplay" class="form-control" readonly>

        <input type="text" name="editcompany_id" id="editcompany_id" class="form-control" hidden>

        <span class="form-bar"></span>

        <div class="form-group form-primary">
        <label class="float-label">Company Name</label>
        <input type="text" name="editcompanyname" id="editcompanyname" class="form-control" >
        <span class="form-bar"></span>
        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Edit Company</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





