<style type="text/css">
   .system-form::-webkit-scrollbar {
    width: 10px;
}

</style>
<form id="main" method="post" class="system-form" action="/" novalidate="" style="top: 50%;
    height: 77Vh;
    overflow-y: scroll;overflow-x: hidden;">    
   
   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Platform</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="platform" id="platform" required>
             <option value="">Please Select Platform</option>
              
             <option>Window</option>
             <option>Mac</option>
 
         </select>
         <span class="messages"></span>
      </div>
   </div>
<div class="form-group row ">
      <label class="col-sm-4 col-form-label">Device</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="device" id="device"  required>
             <option value="">Please Select Device</option>
             <option>Phone</option>
             <option>Laptop</option>  
         </select>
         <span class="messages"></span>
      </div>
   </div>
   <div class="form-group row ">
      <label class="col-sm-4 col-form-label">System Name</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="system_name" id="system_name" placeholder="Enter System Name" >
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
    <div class="form-group row ">
      <label class="col-sm-4 col-form-label">Generation</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="gen" id="gen" required>
             <option value="">Please Select Generation</option>
             <option value="i3">i3</option>
             <option value="i5">i5</option>
             <option value="i7">i7</option>
             <option value="i8">i8</option>
             <option value="i10">i10</option>  
         </select>
         <span class="messages"></span>
      </div>
   </div>
    <div class="form-group row ">
      <label class="col-sm-4 col-form-label">RAM</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="ram" id="ram" required>
             <option value="">Please Select RAM</option>
             <option>3 GB</option>
             <option>4 GB</option>
             <option>6 GB</option>
             <option>8 GB</option>
             <option>16 GB</option>
             <option>32 GB</option>    
         </select>
         <span class="messages"></span>
      </div>
   </div>

   <div class="form-group row">
      <label class="col-sm-4 col-form-label">Storage</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="storage" id="storage" required>
             <option value="">Please Select Storage</option>
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
         <input type="number" class="form-control form-control-primary" name="price" id="price" maxlength="6" placeholder="Enter Price" required>
         <span class="messages"></span>
      </div>
   </div>

<div class="form-group row ">
      <label class="col-sm-4 col-form-label">Purchase From</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="purchase_from" id="purchase_from" placeholder="Enter Purchase From" required>
         <span class="messages"></span>
      </div>
   </div>

   <div class="form-group row ">
      <label class="col-sm-4 col-form-label">Purchase Date</label>
      <div class="col-sm-8">
         <input type="date" class="form-control form-control-primary" name="purchase_date" id="purchase_date" required>
         <span class="messages"></span>
      </div>
   </div>
 <div class="form-group row ">
      <label class="col-sm-4 col-form-label">Dealer Name</label>
      <div class="col-sm-8">
         <input type="text" class="form-control form-control-primary" name="dealer_name" id="dealer_name" placeholder="Enter Dealer Name" >
         <span class="messages"></span>
      </div>
   </div>
<div class="form-group row ">
      <label class="col-sm-4 col-form-label">Employee Name</label>
      <div class="col-sm-8">
         <select class="form-control form-control-primary" name="employee_name" id="employee_name" required>
             <option value="">Please Select</option>
             <option value="0">Spare</option>
             
              @foreach(EmployeeList() as $user)
      <option value="{{$user->id}}">{{$user->full_name}} ({{$user->designation_name}})</option>
      @endforeach      
         </select>
         <span class="messages"></span>
      </div>
   </div>

   <div class="form-group row ">
         <label class="col-sm-4 col-form-label">Invoice</label>
         <div class="col-sm-8">
         <input class="form-control" type="file" name="invoice" id="invoice">
         <span class="messages"></span>
         </div>
    </div>
 
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
   </div>
</form>