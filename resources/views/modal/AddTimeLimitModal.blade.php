

<!-- // ADD NEW EMPLOYEE MODAL -->




<!-- Modal -->
<div class="modal fade" id="addtimelimitmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="staticBackdropLabel" >Add Time in/Time out Limit</h5>
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- MODAL BODY-->
      <div class="modal-body">
        <!-- Credentials -->

    <form id="addtimelimitform">
      @csrf
      <div class="form-group form-primary">

        <div class="form-group form-primary">

        <label class="float-label">Time In Limit</label><br>
        <label for="appt">Select a time in:</label>
        <input type="time" id="timein" name="timein" style="width:100%;">
        <br>
        <label for="appt">Select a time out:</label><br>
        <input type="time" id="timeout" name="timeout" style="width:100%;">

        
         </div>
      </div>
      <div class="modal-footer">

        <button type="submit"  class="btn btn-success">Add New Time Limit</button>
      </div>
     </div>
     </form>
  </div>
 </div>
</div>





