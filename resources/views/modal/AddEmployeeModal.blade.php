

<!-- // ADD NEW EMPLOYEE MODAL -->
<button type="button" class="btn btn-success" onclick="addmodal()" > 
  Add New Employee
</button>



<!-- Modal -->
<div class="modal fade" id="addemployeemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="clearform()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->
       
    <form id="addform">
      @csrf
      <div class="form-group form-primary">

        <label class="float-label" id="luseremployee" style="display:none;">Employee ID</label>
          <select class="form-control" name="useremployee" id="useremployee">
            <option selected="selected" value="" disabled>Employee ID List</option>
          </select>


        <input type="text" name="emp_idadd" id="emp_idadd" class="form-control" hidden>

        <span class="form-bar"></span>

        <div class="form-group form-primary">
        <label class="float-label">Name</label>
        <input type="text" name="addname" id="addname" class="form-control" >
        <span class="form-bar"></span>

        <label class="float-label">Logs</label>
        <input type="text" name="logsadd" id="logsadd" class="form-control" >
        <span class="form-bar"></span>

        <label class="float-label">Status</label>
        <input type="text" name="statusadd" id="statusadd" class="form-control" >
        <span class="form-bar"></span>

        <label class="float-label">Type</label>
        <input type="text" name="typeadd" id="typeadd" class="form-control" >
        <span class="form-bar"></span>
        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Add new Employee</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>


<script>
function clearform(){
  document.getElementById("addname").value = "";
document.getElementById("logsadd").value = "";
document.getElementById("statusadd").value = "";
document.getElementById("typeadd").value = "";


}



</script>



