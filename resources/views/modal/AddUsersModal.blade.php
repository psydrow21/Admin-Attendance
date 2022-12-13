<!-- // ADD NEW EMPLOYEE MODAL -->
<button type="button" class="btn btn-dark" onclick="addusersmodal()" style="margin-left:80%"> 
    Add new users
  </button>
  
  
  
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="addusersmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          
          <h5 class="modal-title" id="staticBackdropLabel" >Add Users</h5>
          <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="clearsform()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- MODAL BODY-->
        <div class="modal-body">
          <!-- Credentials -->
  
          <input type="radio" id="branchline" name="branchline" value="HeadOffice">
          <label for="html">Head Office</label>
          <input type="radio" id="branchline" name="branchline" value="ProjectSite">
          <label for="html">Project Site</label>
          <input type="radio" id="branchline" name="branchline" value="EverFirst">
          <label for="html">Everfirst Branches</label><br>
      <form id="adduserform">
        @csrf
        
        <input type="text" id="branchlineval" name="branchlineval" hidden>
     
        <div class="form-group form-primary">
          <label class="float-label" id="luseremployee" style="display:none;">Employee ID</label>
          <select class="form-control" name="useremployee" id="useremployee">
            <option selected="selected" value="" disabled>Employee ID List</option>
            @foreach ($checking as $ekey)
              @php
                $check = DB::table('users')->where('empid', $ekey->empid)->exists();   
              @endphp
          
          @if(!$check)
            <option  value="{{ $ekey->empid }}" >{{ $ekey->empid }}</option>
          @endif
  
            @endforeach
          </select>
         
    
    
        <div class="form-group form-primary">
          <label class="float-label">Name</label>
          <input type="text" name="NameUser" id="NameUser" class="form-control" disabled>
          <span class="form-bar"></span>
       
  
          <div class="form-group form-primary">
          <label class="float-label">Email</label>
          <input type="email" name="EmailUser" id="EmailUser" class="form-control" disabled>
          <span class="form-bar"></span>
  
          <label class="float-label">Username</label>
          <input type="text" name="UsernameUser" id="UsernameUser" class="form-control" disabled>
          <span class="form-bar"></span>
  
          <label class="float-label">Password</label>
          <input type="password" name="PasswordUser" id="PasswordUser" class="form-control" disabled>
          <span class="form-bar"></span>

          {{-- Project Site Options --}}
          <label class="float-label" id="lteam" style="display:none;">Team</label>
          <select class="form-control" name="team" id="team" style="display:none;">
            <option selected="selected" value="" disabled>Team List</option>
          @foreach ($team as $tkey)
          <option value="{{ $tkey->id }}"> {{ $tkey->teamname }}</option>
          @endforeach
          </select>

        
          <label class="float-label" id="lOIC" style="display:none;">OIC Operation Manager (Under By)</label>
          <select class="form-control" name="OIC" id="OIC" disabled style="display:none;">
            <option selected="selected" value="" disabled>Operation Manager List</option>
       
          </select>

          <label class="float-label" id="lPM" style="display:none;">Project Manager</label>
          <select class="form-control" name="ProjectManager" id="ProjectManager" disabled style="display:none;">
            <option selected="selected" value="" disabled>Project Manager List</option>
         
          </select>


         
          
          {{-- Branches Options --}}
          <label class="float-label" id="ldistrict" style="display:none;">District</label>
          <select class="form-control" name="district" id="district" disabled style="display:none;">
            <option selected="selected" value="" disabled>District List</option>
          @foreach ($district as $dkey)
          <option value="{{ $dkey->district_code }}"> {{ $dkey->district_number }}</option>
          @endforeach
          </select>

          <label class="float-label" id="larea" style="display:none;">Area</label>
          <select class="form-control" name="area" id="area" disabled style="display:none;">
            <option selected="selected" value="" disabled>Area List</option>
          @foreach ($area as $akey)
          <option value="{{ $akey->area_code }}"> {{ $akey->area_no }}</option>
          @endforeach
          </select>

          <label class="float-label" id="lbranch" style="display:none;">Branch</label>
          <select class="form-control" name="branch" id="branch" disabled style="display:none;">
            <option selected="selected" value="" disabled>Branch List</option>
          @foreach ($branch as $key)
          <option value="{{ $key->branch_code }}"> {{ $key->branch_loc }}</option>
          @endforeach
          </select>
          
          
          {{-- Head Office Options --}}
          <label class="float-label" id="lposition" style="display:none;">Position</label>
          <select class="form-control" name="position" id="position"  style="display:none;">
            <option selected="selected" value="" disabled>Position List</option>
          @foreach ($position as $pkey)
          <option value="{{ $pkey->user_code }}"> {{ $pkey->group_name }}</option>
          @endforeach
          </select>


           </div>
        </div>
        <div class="modal-footer">
  
          <button type="submit"  class="btn btn-success">Add new User</button>
        </div>
       </div>
       </form>
    </div>
   </div>
  </div>
</div>

