<form id="main" method="post" action="/" novalidate="" >
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Title</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="title" id="title" placeholder="Enter Title">
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Message</label>
      <div class="col-sm-8">
         <textarea class="form-control form-control-primary" name="message" id="message" placeholder="Enter Message" rows="4"></textarea>
         <span class="messages"></span>
      </div>
   </div>
   
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
   </div>
</form>