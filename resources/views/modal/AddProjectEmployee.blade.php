<!-- // ADD NEW EMPLOYEE MODAL -->


  {{-- <button type="button" class="btn btn-success" onclick="addteammodal()" style="margin-left:5%;"> 
    Add New Department
  </button> --}}

   
   


{{-- 
  <button type="button" class="btn btn-primary" onclick="addtimelimitmodal()" style="margin-left:5%;"> 
    Add New Limit Logs
  </button> --}}




  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="addengineersmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          
          <h5 class="modal-title" id="staticBackdropLabel" >Add new employee</h5>
          <button type="button" class="close" data-dismiss="modal"  aria-label="Close" onclick="resetemployeeform()";>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- MODAL BODY-->
        <div class="modal-body">
          <form id="addempform">
            @csrf
          <!-- Credentials -->
            
          <div class="container">
            <div class="row">
            <div class="col-6">
              <strong class="float-label" id="">Employee Details :</strong>
              <br>
      {{-- User Role Option --}}
      <label class="float-label">User Role:</label>
      <br>
      <input type="radio" id="addroleline" name="addroleline" value="1">
      <label for="html">Super Admin(Cloud All logs Access)</label>
      <br>
      <input type="radio" id="addroleline" name="addroleline" value="2">
      <label for="html">Admin(Local 1 Branch Access & Own Logs Access)</label>
      <br>
      <input type="radio" id="addroleline" name="addroleline" value="3">
      <label for="html">User(Own Logs Access)</label><br>



              <label class="float-label" id="laddcompany">Company</label>
              <select class="form-control" name="addcompany" id="addcompany">
                <option selected="selected" value="" disabled>Company List</option>
              @foreach ($companyread as $ckey)
              <option value="{{ $ckey->company_id }}"> {{ $ckey->company_name }}</option>
              @endforeach
              </select>
  
              <label class="float-label" id="lcopydetails">Copy the details to the other locationn</label>
              <select class="form-control" name="copydetails" id="copydetails">
                <option selected="selected" value="" disabled>Biometrics Location Registered List</option>
             
             @php
               if(!$sock = @fsockopen('www.google.com', 80))
          {
    
          }
          else
          {
            
            foreach ($locationfilter as $lkey){
             echo  '<option value="'.$lkey->id.'">'.$lkey->location.'</option>';
            }
          
              
          }
            
           @endphp
              </select>
  
              {{-- <label class="float-label" id="laddcompany">Company</label>
              <select class="form-control" name="addcompany" id="addcompany">
                <option selected="selected" value="2">EverFirst</option>
              </select> --}}
           
          
  
            <label class="float-label">Location</label>
            <br>
            {{-- <input type="radio" id="addbranchline" name="addbranchline" value="HeadOffice">
            <label for="html">Filipinas Multi-Line Corp.</label> --}}
            {{-- <input type="radio" id="addbranchline" name="addbranchline" value="ProjectSite">
            <label for="html">Project Site</label> --}}
            <input type="radio" id="addbranchline" name="addbranchline" value="EverFirst">
            <label for="html">EverFirst Branches</label><br>
            
            <div id="addpositions">
            <label class="float-label" id="laddprojectlines">Position</label><br>
            <input type="radio" id="addprojectlines" name="addprojectlines" value="OperationManager">
            <label for="html" name="addprojectlines">Operation Manager</label>
  
            <input type="radio" id="addprojectlines" name="addprojectlines" value="ProjectManager">
            <label for="html" name="addprojectlines">Project Manager</label>
  
            <input type="radio" id="addprojectlines" name="addprojectlines" value="ProjectEngineer">
            <label for="html" name="addprojectlines">Project Engineer</label><br>
            </div>
            
            
            {{-- <div id="addeverpositions">
              <label class="float-label" id="laddeverline">Position</label><br>
              <input type="radio" id="addeverline" name="addeverline" value="Manager">
              <label for="html" name="addeverline">Manager</label>
    
              <input type="radio" id="addeverline" name="addeverline" value="Supervisor">
              <label for="html" name="addeverline">Supervisor</label>
    
              <input type="radio" id="addeverline" name="addeverline" value="RAF">
              <label for="html" name="addeverline">Rank and file</label><br>
              </div> --}}
       
  
          <input type="text" id="addprojectline" name="addprojectline" hidden>
        
          <input type="text" id="branchlineval" name="branchlineval" hidden>
         
        
         
          <div class="form-group form-primary">
              <label class="float-label">Employee ID</label>
              <input type="text" name="addEmpid" id="addEmpid" class="form-control" disabled>
              <span class="form-bar"></span>
    
  
            {{-- Project Site Options --}}
            <label class="float-label" id="laddteam" style="display:none;">Team</label>
            <select class="form-control" name="addteam" id="addteam" style="display:none;">
              <option selected="selected" value="" disabled>Team List</option>
            @foreach ($team as $tkey)
            <option value="{{ $tkey->id }}"> {{ $tkey->teamname }}</option>
            @endforeach
            </select>
  
          
            <label class="float-label" id="laddOIC" style="display:none;">OIC Operation Manager (Under By)</label>
            <select class="form-control" name="addOIC" id="addOIC" disabled style="display:none;">
              <option selected="selected" value="" disabled>Operation Manager List</option>
            </select>
  
            <label class="float-label" id="laddProjectManager" style="display:none;">Project Manager</label>
            <select class="form-control" name="addProjectManager" id="addProjectManager" disabled style="display:none;">
              <option selected="selected" value="" disabled>Project Manager List</option>
           
            </select>
  
          
            {{-- EverFirst Department Options  --}}
            <label class="float-label" id="ldepartment" style="display:none;" >Department</label>
            <select class="form-control" name="department" id="department" disabled style="display:none;">
              <option selected="selected" value="" disabled>Department List</option>
            @foreach ($department as $dpkey)
            <option value="{{ $dpkey->id }}"> {{ $dpkey->department_name }}</option>
            @endforeach
            </select>
  
            {{-- EverFirst Position Options  --}}
      
            <label class="float-label" id="lpositions" style="display:none;">Position</label>
            <select class="form-control" name="positions" id="positions" disabled style="display:none;">
              <option selected="selected" value="" disabled>Position List</option>
  
            @foreach ($departmentposition as $poskey)
            <option value="{{ $poskey->id }}"> {{ $poskey->posname }}</option>
            @endforeach
          </select>
  
  
  
             {{-- Branches Options --}}
             <label class="float-label" id="ladddistrict" style="display:none;">District</label>
             <select class="form-control" name="adddistrict" id="adddistrict" disabled style="display:none;">
               <option selected="selected" value="" disabled>District List</option>
             @foreach ($district as $dkey)
             <option value="{{ $dkey->district_code }}"> {{ $dkey->district_number }}</option>
             @endforeach
             </select>
   
             <label class="float-label" id="laddarea" style="display:none;">Area</label>
             <select class="form-control" name="addarea" id="addarea" disabled style="display:none;">
               <option selected="selected" value="" disabled>Area List</option>
             @foreach ($area as $akey)
             <option value="{{ $akey->area_code }}"> {{ $akey->area_no }}</option>
             @endforeach
             </select>
   
             <label class="float-label" id="laddbranch" style="display:none;">Branch</label>
             <select class="form-control" name="addbranch" id="addbranch" disabled style="display:none;">
               <option selected="selected" value="" disabled>Branch List</option>
             @foreach ($branch as $key)
             <option value="{{ $key->branch_code }}"> {{ $key->branch_loc }}</option>
             @endforeach
             </select>
  
             
             
             
             {{-- Head Office Options --}}
             <label class="float-label" id="laddposition" style="display:none;">Position</label>
             <select class="form-control" name="addposition" id="addposition"  style="display:none;">
               <option selected="selected" value="" disabled>Position List</option>
             @foreach ($position as $pkey)
             <option value="{{ $pkey->user_code }}"> {{ $pkey->group_name }}</option>
             @endforeach
             </select>
          </div>
        </div>
        <div class="col-6">
          <strong class="float-label" id="">User Details :(For access in web)</strong>
          <br>

          <div class="form-group form-primary">
            <label class="float-label">First Name</label>
            <input type="text" name="AddFirstNameUser" id="AddFirstNameUser" class="form-control" :invalid >
            <span class="form-bar"></span>
           
              <label class="float-label">Middle Name</label>
              <input type="text" name="AddMiddleNameUser" id="AddMiddleNameUser" class="form-control" :invalid >
              <span class="form-bar"></span>
          
                <label class="float-label">Last Name</label>
                <input type="text" name="AddLastNameUser" id="AddLastNameUser" class="form-control" :invalid >
                <span class="form-bar"></span>
         
              <label class="float-label">Email</label>
              <input type="email" name="AddEmailUser" id="AddEmailUser" class="form-control" >
              <span class="form-bar"></span>
      
              <label class="float-label">Username</label>
              <input type="text" name="AddUsernameUser" id="AddUsernameUser" class="form-control">
              <span class="form-bar"></span>
      
              <label class="float-label">Password</label>
              <input type="password" name="AddPasswordUser" id="AddPasswordUser" class="form-control" >
              <span class="form-bar"></span>
            <br>
           


          
         
          </div>
          </div>  
           </div>
        </div>
        <div class="modal-footer">
  
          <button type="submit"  class="btn btn-success">Add New Employee</button>
        </div>
      </div>
       </div>
       </form>
    </div>
   </div>


