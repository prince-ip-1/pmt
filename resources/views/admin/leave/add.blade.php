<form id="main" method="post" action="/" novalidate="" >

 
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Title</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="title" id="title" placeholder="Enter Title">
         <span class="messages"></span>
      </div>
   </div>

    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Reason</label>
      <div class="col-sm-8">
         <textarea class="form-control form-control-primary" name="reason" id="reason" placeholder="Enter Reason" rows="3"></textarea>
         <span class="messages"></span>
      </div>
   </div>
   
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Leave Days</label>
      <div class="col-sm-8">
         <select name="leave_type" class="form-control show-tick leave_type"  id="leave_type">
         <option value="">Select Leave Days</option>
         <option value="0.5">0.5</option>
         <option value="1.0">1.0</option>
         <option value="1.5">1.5</option>
         <option value="2.0">2.0</option>
         <option value="2.5">2.5</option>
         <option value="3.0">3.0</option>
         <option value="3.5">3.5</option>
         <option value="4.0">4.0</option>
         <option value="4.5">4.5</option>
         <option value="5.0">5.0</option>
         <option value="5.5">5.5</option>
         <option value="6.0">6.0</option>
         <option value="6.5">6.5</option>
         <option value="7.0">7.0</option>
         <option value="7.5">7.5</option>
         <option value="8.0">8.0</option>
         <option value="8.5">8.5</option>
         <option value="9.0">9.0</option>
         <option value="9.5">9.5</option>
         <option value="10.0">10.0</option>
         <option value="11">Others</option>
     </select>
         <span class="messages"></span>
      </div>
   </div>
   <div  id="leave_days_others" style="display: none;">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Other Leave (In Days)</label>
            <div class="col-sm-8">
             <input name="leave_days_others" type="number" class=" form-control" placeholder="Enter Other Days">
             <span class="messages"></span>
            </div>
        </div>
   </div>
  
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Start Date</label>
      <div class="col-sm-8">
         <input class="form-control" type="date" name="start_date" id="start_date">
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row ed">
      <label class="col-sm-4 col-form-label">End Date</label>
      <div class="col-sm-8">
         <input class="form-control" type="date" name="end_date" id="end_date">
         <span class="messages"></span>
      </div>
   </div>
   

  
 
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round btn-close">Close</button>
   </div>
</form>

