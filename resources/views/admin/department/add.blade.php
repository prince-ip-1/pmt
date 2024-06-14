<form id="main" method="post" action="/" novalidate="">
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Department Name</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="department_name" id="department_name" placeholder="Enter Department Name" >
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Status</label>
      <div class="col-sm-8">
         <div class="form-radio">
            <div class="radio radiofill radio-primary radio-inline">
               <label>
               <input type="radio" name="status" value="1" data-bv-field="status">
               <i class="helper"></i>Active
               </label>
            </div>
            <div class="radio radiofill radio-primary radio-inline">
               <label>
               <input type="radio" name="status" value="2" data-bv-field="status">
               <i class="helper"></i>Deactive
               </label>
            </div>
         </div>
         <span class="messages"></span>
      </div>
   </div>
 
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
   </div>
</form>