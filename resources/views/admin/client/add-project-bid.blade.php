<form id="bid_form" method="post" action="/" novalidate="">
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Category Name</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="category_name" id="category_name" required placeholder="Enter Category Name" >
         
         <span  class="messages" style="position: absolute;"><p  id="category_name_message" class=" text-danger error"></p></span>
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
      <button type="submit" class="btn btn-primary btn-round save_project_bid m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect close_project_bid_model md-close btn-round">Close</button>
   </div>
</form>