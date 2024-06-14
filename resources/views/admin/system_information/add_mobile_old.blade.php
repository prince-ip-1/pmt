<style type="text/css">
   .system-form::-webkit-scrollbar {
    width: 10px;
}

</style>
<form id="main" method="post" class="system-form" action="/" novalidate="" style="top: 50%;
    height: 77Vh;
    overflow-y: scroll;overflow-x: hidden;height:340px;">    
   
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Platform</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="platform" id="platform" required>
             <option value="">Please Select Platform</option>
             <option>Android</option>
             <option>IOS</option>    
             <option>Window</option>
             <option>Mac</option>
 
         </select>
         <span class="messages"></span>
      </div>
   </div>

   
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">System Model</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="system_model" id="system_model" placeholder="Enter System Model" >
         <span class="messages"></span>
      </div>
   </div>
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">OS Version</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="os_version" id="os_version" placeholder="Enter OS Version" >
         <span class="messages"></span>
      </div>
   </div>
   

   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Storage</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="storage" id="storage" required>
             <option value="">Please Select Storage</option>
              <option>4 GB</option>
              <option>8 GB</option>
               <option>16 GB</option>
             <option>32 GB</option>
             <option>64 GB</option>
             <option>128 GB</option>
             <option>256 GB</option>
             <option>500 GB</option>
             <option>1 TB</option>
             <option>2 TB</option>
         </select>
         <span class="messages"></span>
      </div>
   </div>
   
   <div class="form-group row ">
      <label class="col-sm-4 col-form-label">Price</label>
      <div class="col-sm-8">
         <input type="number" class="form-control form-control-primary" name="price" id="price" maxlength="6" placeholder="Enter Price">
         <span class="messages"></span>
      </div>
   </div>
   
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect btn-close btn-round">Close</button>
   </div>
</form>