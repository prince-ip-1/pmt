<form id="main" method="post" action="/" novalidate="" >
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Holiday Name</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="holiday_name" id="holiday_name" placeholder="Enter Holiday Name">
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Holiday Description</label>
      <div class="col-sm-8">
         <textarea class="form-control form-control-primary" name="holiday_description" id="holiday_description" placeholder="Enter Holiday Desciption" rows="3"></textarea>
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Start Date</label>
      <div class="col-sm-8">
         <input class="form-control" type="date" name="start_date" id="start_date1">
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">End Date</label>
      <div class="col-sm-8">
         <input class="form-control" type="date" name="end_date" id="end_date">
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
   <!-- <div class="form-group row">
      <label class="col-sm-2"></label>
      <div class="col-sm-5">
          <button type="submit" class="btn btn-danger m-b-0">Submit</button>
       
      </div>
      <div class="col-sm-5">
          <button type="button" class="btn btn-primary waves-effect md-close">Close</button>
      </div>
      </div> -->
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
   </div>
</form>