<style>
 
.table td{
    padding: 0px!important;
    /*padding: 0.75rem;*/
}
/* form field design start */
.form_control {
    border: 1px solid #0002;
    background-color: transparent;
    outline: none;
    padding: 8px 12px;
    font-family: 1.2rem;
    width: 100%;
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    transition: 0.3s ease-in-out;
}

.form_control::placeholder {
    color: inherit;
    opacity: 0.5;
}

.form_control:is(:focus, :hover) {
    box-shadow: inset 0 1px 6px #0002;
}

/* form field design end */


.success {
    background-color: #24b96f !important;
}

.warning {
    background-color: #ebba33 !important;
}

.primary {
    background-color: #259dff !important;
}

.secondery {
    background-color: #00bcd4 !important;
}

.danger {
    background-color: #ff5722 !important;
}

.action_container {
    display: inline-flex;
}

.action_container>* {
    border: none;
    outline: none;
    color: #fff;
    text-decoration: none;
    display: inline-block;
    padding: 8px 14px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

.action_container>*+* {
    border-left: 1px solid #fff5;
}
.margin-top{
    margin-top : 6px;
}
.action_container>*:hover {
    filter: hue-rotate(-20deg) brightness(0.97);
    transform: scale(1.05);
    border-color: transparent;
    box-shadow: 0 2px 10px #0004;
    border-radius: 2px;
}

.action_container>*:active {
    transition: unset;
    transform: scale(.95);
}
</style>
@extends('layouts.default')
@section('content')
 

<div class="main-body">
    <div class="page-wrapper">
        	<!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
        	<div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <div class="card-block">
                                <div id="wizard1">
                                <section>
     <form class="other_expense_form" id="other_expense" method="post" action="{{URL::to('admin/add_other_expense')}}" novalidate="" enctype="multipart/form-data">
         {{csrf_field()}}
         <input type="hidden" id="table_name" value="other_expense">
         <input type="hidden" name="id" id="other_expense_id" value="{{$data['other_expense_details']->id}}">
         <input type="hidden" name="old_invoice" id="old_invoice" value="{{$data['other_expense_details']->invoice}}">
   <div class="row">
          <div class="col-sm-4 form-group">
         <label class="block">Category</label>
         <select name="category" class="form-control  show-tick category">
            <option value="">Select Category</option>
             @foreach($data['category'] as $key=>$row)
                    <option  {{$data['other_expense_details']->category == $row->id?"selected":""}} value="{{$row->id}}">{{$row->category_name}}</option>
            @endforeach
            <option value="-1" style="color: #01a9ac;">+ Add New Item</option>
            
        </select>
         <span class="messages"></span>
      </div>
       
        <div class="col-sm-4 form-group">
      <label class="block">Date</label>
     
         <input class="form-control " type="date" name="date" value="{{$data['other_expense_details']->date}}">
         <span class="messages"></span>
      </div>
        <div class="col-sm-4 form-group">
      <label class="block">Paid By</label>
        <select name="paid_by" class="form-control  show-tick" id="paid_by" >
           <option value="id">Select</option>
            <option {{$data['other_expense_details']->full_name == ""?"selected":""}} value="99999">Bluepixel</option>
           @foreach(employeelist() as $key=>$val)
            <option {{$data['other_expense_details']->full_name == $val->full_name?"selected":""}} value="{{$val->id}}">{{$val->full_name}} ({{$val->designation_name}})</option>
           @endforeach      
        </select>
       
         <span class="messages"></span>
      </div>
    </div>
  
     <div class="row">
          <div class="col-sm-4 form-group">
      <label class="block">Payment Type</label>
          <select name="payment_type" class="form-control show-tick payment_type" >
         <option value="">Select Payment Type</option>
          @foreach(getPaymentType() as $key=>$val)
                    <option {{$data['other_expense_details']->payment_type == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
            @endforeach
      </select>
         <span class="messages"></span>
      </div>
       <div class="col-sm-4 form-group">
      <label class="block">Invoice</label>
         <input type="file" class="form-control " name="invoice"  placeholder="Enter Invoice" value="{{URL::to('/uploads/invoice/'.$data['other_expense_details']->invoice)}} ">
         <span class="messages"></span>
      </div>
        <div class="col-md-4 form-group" style="padding: 27px;">
           <label class="block"></label>
          <input type="checkbox" name="is_include_tax" id="is_include_tax" {{$data['other_expense_details']->is_include_tax == 1 ? 'checked' : ''}} value="1">
          <label for="is_include_tax">Is Include Tax?</label>
          <span data-toggle="tooltip" data-placement="right" title="GST Includes"> <i class="fa fa-info-circle"></i></span>
           
    </div>
       </div>
               <div class="row "><div class="col-md-12">
                     @php
                    if($data['other_expense_details']->is_include_tax != 1){
                        $class = "d-none";
                    }
                    else{
                        $class = "";
                    }
                    @endphp
   <table id="myTable" class="table table-bordered">
    <thead>
      <tr>
        <th >Item Name</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th>Amount</th>
        <th class="is_include_tax {{$class}}">Tax(%)</th>
        <th class="is_include_tax {{$class}}">Tax Amount</th>
        <th>Net Amount</th>
        <th>
          <div class="action_container">
            <button type="button" class="success" onclick="AddNewItem()">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </th>
      </tr>
    </thead>
    <tbody id="myTableRow">
        @if(!empty($data['other_exp_items']))
        @foreach($data['other_exp_items'] as $k => $val)
        @php $index = $k + 1; @endphp
         <tr>
               <td>
            <input type="hidden" class="form_control id" name="item[{{$index}}][id]" placeholder="Item Name" value={{$val['id']}}>
              <input type="text" class="form_control item_name" name="item[{{$index}}][item_name]" placeholder="Item Name" value={{$val['item_name']}}></td>
             </td>
             <td><input type="number" class="form_control quantity" name="item[{{$index}}][quantity]" placeholder="Quantity" value={{$val['quantity']}}></td>
             <td><input type="number" class="form_control rate" name="item[{{$index}}][rate]" placeholder="Rate" value={{$val['rate']}}></td>
             <td><input type="text" class="form_control amount" name="item[{{$index}}][amount]" placeholder="Amount" value={{$val['amount']}}></td>
             <td class="is_include_tax {{$class}}"><input type="number" class="form_control tax is_include_tax {{$class}}" name="item[{{$index}}][tax]" placeholder="Tax" value={{$val['tax']}}></td>
             <td class="is_include_tax {{$class}}"><input type="number" class="form_control tax_amount is_include_tax {{$class}}" name="item[{{$index}}][tax_amount]" placeholder="Tax Amount" value={{$val['tax_amount']}}></td>
             <td><input type="number" class="form_control net_amount" name="item[{{$index}}][net_amount]" placeholder="Net Amount" value={{$val['net_amount']}}></td>
             <td></td>
         </tr>
         @endforeach
         @endif
    </tbody>
  </table>
  </div>
</div>
                
        <br><br>
         <div class="row">
          <div class="col-sm-4 form-group">
             <textarea class="form-control" name="expense_description" id="expense_description"  placeholder="Enter Expense Desciption" rows="3">{{$data['other_expense_details']->description}}</textarea>
             <span class="messages"></span>
          </div>
           <div class="col-md-3"></div>
          <div class="col-md-4 add-form-footer p-2">
                <div class="row">
                   <div class="col-md-6">
                      <span><b>Subtotal</b></span>
                   </div>
                  
                   <div class="col-md-5">
                      <input type="text"  class="form-control form-border" name="amount" id="sub-total" value="{{$data['other_expense_details']->amount}}" readonly>
                   </div>
                </div>
                 <br>
                <div class="row">
                    @php
                    if($data['other_expense_details']->is_include_tax != 1){
                        $class = "d-none";
                    }
                    else{
                        $class = "";
                    }
                    @endphp
                   <div class="col-md-6 is_include_tax  {{$class}}">
                      <span><b>Tax</b></span>
                   </div>
                   <div class="col-md-5  is_include_tax {{$class}}">
                        <input type="hidden" value="" name="tax_value" id="tax_value">
                       <input type="text" value="{{$data['other_expense_details']->tax_value}}" class="form-control form-border tax_value" name="tax_value" id="tax_value" >
                      
                   </div>
                </div>
                
                <hr>
                 <div class="row form-footer-right">
                   <div class="col-md-6">
                      <span><b>Total</b></span>
                   </div>
                   <div class="col-md-5">
                      <span><input type="text" class="form-control form-border" name="total_amount" id="total-amount" value="{{$data['other_expense_details']->total_amount}}" readonly></span>
                   </div>
                </div>
             </div>
    </div>
     
    
    <div class="form-footer text-right">
    <button type="submit" class="btn btn-primary">Submit</button>
   </div>
</form>
</section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-1">
      <div class="md-content">
         <h3>Expense Category</h3>
         <div>
            @include('admin.other_expense.add_category')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
@stop