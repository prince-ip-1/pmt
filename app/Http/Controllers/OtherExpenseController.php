<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherExpenseModel;
use App\Models\OtherExpenseItemModel;
use App\Models\ExpenseCategoryModel;
use DB;
class OtherExpenseController extends Controller
{
    public function other_expense()
    {
        $data['title'] = "Other Expense";
        $data['sub_title'] = "";
        $data['sidebar']='Other Expense';

        $data['other_expense'] = OtherExpenseModel::orderBy('date','desc')->get();
        $data['amount'] = OtherExpenseModel::select('other_expense.amount')->sum('amount');
        $data['category'] = ExpenseCategoryModel::orderBy('id','desc')->where('status','=',1)->get();
        return view('admin.other_expense.add',compact('data'));
    }
    public function add_expense(Request $request)
    {
        $invoiceitem = "";
        if($request->file('invoice'))
        {
             $invoice = $request->file('invoice');
             $invoiceitem = time().'.'.$invoice->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/invoice');
             $invoice->move($destinationPath,$invoiceitem);
        }
        else
        {
            $invoiceitem = $request->old_invoice;
        }
      
        if(!empty($request->id)){
             $other_expense = OtherExpenseModel::find($request->id);
           
             if(empty($request->file('invoice'))){
               $invoiceitem = $request->old_invoice;
             }  
             $status = 'true';
             $message = 'Data updated successfully.';
         }else{
            $other_expense = new OtherExpenseModel;
            $status = 'true';
            $message = 'Data addedd successfully.';
         }
         
       // $other_expense = new OtherExpenseModel;
        $other_expense->description = $request->expense_description;
        $other_expense->date = $request->date;
        $other_expense->payment_type = $request->payment_type;
        $other_expense->paid_by = $request->paid_by;
        $other_expense->invoice = $invoiceitem;
        $other_expense->category = $request->category;
        
        $other_expense->save();
    
        foreach($request->data as $row)
        {
            $otherexpenseitem = new OtherExpenseItemModel;
            $otherexpenseitem->item_name =$row['item_name'];
            $otherexpenseitem->quantity = $row['quantity'];
            $otherexpenseitem->rate = $row['rate'];
            $otherexpenseitem->amount = $row['amount'];
            $otherexpenseitem->save();
            
        }
        return response()->json(compact('status','message'));
    }
    
     public function list_other_expense()
    {
        $data['title'] = "Other Expense List";
        $data['sub_title'] = "";
        $data['sidebar']='Other Expense';
        $data['amount'] = OtherExpenseModel ::select('other_expense.amount')->sum('amount');
         $data['other_expense'] = OtherExpenseModel::select('other_expense.*','e.first_name','e.last_name','ec.category_name','e2.first_name as f_name','e2.last_name as l_name')
        ->leftjoin('expense_category as ec','ec.id','=','other_expense.category')
        ->leftjoin('employee as e2','e2.id','=','other_expense.created_by')
        ->leftjoin('employee as e','e.id','=','other_expense.paid_by')
        ->orderBy('date','desc')->get(); 
        return view('admin.other_expense.other_expense',compact('data'));
    }
    
     public function edit_other_expense($id)
    {
        $data['title']='Edit Other Expense';
        $data['sub_title']= 'Other Expense';
        $data['sidebar']= 'Other Expense';
        $data['sub_title_url']= 'admin/list_other_expense';
        
        $data['category'] = ExpenseCategoryModel::orderBy('id','desc')->where('status','=',1)->get();
       
        $data['other_expense_details'] = OtherExpenseModel::select('other_expense.*','e.id as e_id',DB::raw("CONCAT(e.first_name,' ',e.last_name) as full_name"))->leftjoin('employee as e','e.id','=','other_expense.paid_by')->where('other_expense.id',$id)->first();
       
        $data['other_exp_items'] = OtherExpenseItemModel::where('other_expense_id',$id)->get();
        
        return view('admin.other_expense.edit_other_expense',compact('data'));
    }
    public function add_other_expense(Request $request)
    {
       
        $invoiceitem = "";
        if($request->file('invoice'))
        {
             $invoice = $request->file('invoice');
             $invoiceitem = time().'.'.$invoice->getClientOriginalExtension();
             $destinationPath = public_path('/uploads/invoice');
             $invoice->move($destinationPath,$invoiceitem);
        }
        else
        {
            $invoiceitem = $request->old_invoice;
        }
        
        if(!empty($request->id)){
             $other_expense = OtherExpenseModel::find($request->id);
           
             if(empty($request->file('invoice'))){
               $invoiceitem = $request->old_invoice;
             }  
             $status = 'true';
             $message = 'Data updated successfully.';
         }else{
            $other_expense = new OtherExpenseModel;
            $status = 'true';
            $message = 'Data addedd successfully.';
         }
         $session = session('user_data');
        $other_expense->description = $request->expense_description;
        $other_expense->date = $request->date;
        $other_expense->payment_type = $request->payment_type;
        $other_expense->paid_by = $request->paid_by;
        $other_expense->invoice = $invoiceitem;
        $other_expense->category = $request->category;
        $other_expense->amount = $request->amount;
        $other_expense->tax_value = $request->tax_value;
        $other_expense->total_amount = $request->total_amount;
        $other_expense->is_include_tax = isset($request->is_include_tax)?($request->is_include_tax):"0";
        $other_expense->created_by = $session->id;
        $other_expense->save();
        
    foreach($request->item as $row)
        {
             //$otherexpenseitem = new OtherExpenseItemModel;
             if(isset($row['id']) && $row['id'] != ""){
                  $otherexpenseitem = OtherExpenseItemModel::find($row['id']);
             }
             else{
                  $otherexpenseitem = new OtherExpenseItemModel;
             }
            $otherexpenseitem->other_expense_id = $other_expense->id;
            $otherexpenseitem->category_id = $other_expense->id;
            $otherexpenseitem->item_name = isset($row['item_name'])?$row['item_name']:"";
            $otherexpenseitem->quantity = isset($row['quantity'])?$row['quantity']:"";
            $otherexpenseitem->tax  = isset($row['tax'])?$row['tax']:"";
            $otherexpenseitem->tax_amount  = isset($row['tax_amount'])?$row['tax_amount']:"";
            $otherexpenseitem->rate = isset($row['rate'])?$row['rate']:"";
            $otherexpenseitem->amount = isset($row['amount'])?$row['amount']:"";
            $otherexpenseitem->net_amount = isset($row['net_amount'])?$row['net_amount']:"";
            $otherexpenseitem->save();
            
        }
       
        return redirect('admin/list_other_expense');
    }
    
    public function download_expenses(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $data = OtherExpenseModel::whereDate('date','>=',$from)->whereDate('date','<=',$to)->get();
        $dataArray = [];

        if(count($data) > 0) {

            foreach ($data as $key => $row) {

                $category = "";
                if($row->category == "0")
                    $category = "Stationary";
                else if($row->category == "1")
                    $category = "Decoration";
                else if($row->category == "2")
                    $category = "Festival";
                else if($row->category == "3")
                    $category = "Sanitary";
                else if($row->category == "4")
                    $category = "Repairing";
                else if($row->category == "5")
                    $category = "Electronics";
                else if($row->category == "6")
                    $category = "Gifts";
                else if($row->category == "7")
                    $category = "Snacks";
                else if($row->category == "8")
                    $category = "Others";

                $tax = '-';
                $taxType = '-';
                if($row->is_include_tax == 1) {
                    $tax = str_replace( ',', '', $row->tax_value );
                    
                    $getTaxValue = OtherExpenseItemModel::select('tax')->where('other_expense_id', $row->id)->first();
                    $taxType = $getTaxValue->tax;
                }
                
                $paymentType = "Online";
                if($row->payment_type == "0")
                    $paymentType = "Card";
                else if($row->payment_type == "1")
                    $paymentType = "Cash";
                    
                $list['srno'] = $key+1;
                $list['date'] = $row->date;
                $list['category'] = isset($category) ? $category : "-";
                $list['description'] = isset($row->description) ? str_replace("\r\n", ' | ', $row->description) : "-";
                $list['payment_type'] = $paymentType;
                $list['tax_type'] = $taxType;
                $list['tax'] = $tax;
                $list['amount'] = str_replace( ',', '', $row->total_amount);
                $dataArray[] = $list;
            }
            
            $res = [
                'status' => true,
                'message' => 'File Downloaded Successfully',
                'data' => $dataArray
            ];
            return $res;
        } else {
            $res = [
                'status' => false,
                'message' => 'Data Not Found'
            ];
            return $res;
        }
    
    }
    public function add_expense_category(Request $request){
         if(isset($request->id) && !empty($request->id)){
            $category = ExpenseCategoryModel::find($request->id);
             $message = 'Data updated successfully.';

        }else{
            $category = new ExpenseCategoryModel;
             $message = 'Data added successfully.';

        }

        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->save();
        $status = 'true';
        $list = ExpenseCategoryModel::where('status','=',1)->orderBy('id','desc')->get();
        $data1 = [];
        $html = '<option value="">Please Select </option>';
        foreach($list as $row){
            $html .= '<option value="'.$row->id.'">'.$row->category_name.'</option>';
            
        }
        $html .= '<option value="-1" style="color: #01a9ac;">+ Add New Item</option>';
        
        return response()->json(compact('status','message','html'));
    } 
    public function expense_category_list(Request $request){
        $data['title'] = "Expense Category";
        $data['sidebar'] = "Other Expense";
        $data['sub_title'] = "";

        $data['category'] = ExpenseCategoryModel::orderBy('id','desc')->get();
        
        return view('admin.other_expense.category_list',compact('data'));
    }  
}
