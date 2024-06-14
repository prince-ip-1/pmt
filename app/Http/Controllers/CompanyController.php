<?php

namespace App\Http\Controllers;
use App\Models\Company;


use Session;
use DB;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
     public function viewprofile()
     {
        $data['title'] = "Company Profile";
        $data['sub_title'] = "";
        $data['sidebar'] = "";
        $data['company'] = Company::orderBy('id','desc')->first();
       
        return view('admin.company.company_profile',compact('data'));
    }

  
    public function add_companyprofile(Request $request)
    {

        $primaryname = "";
        $logoname = "";
        $faviconname = "";
         if(isset($request->id) && !empty($request->id)){
            $c_profile = Company :: find($request->id); 
             $message = 'Data updated successfully.';

            }else{
                $c_profile = new Company;
                 $message = 'Data added successfully.';

            }

        if($request->file('primary_logo') != '')
            {
               
              $image = $request->file('primary_logo');

               $imagePath = public_path('/uploads/Companyprofile'.$image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                } 

              $primaryname = time().'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/uploads/Companyprofile');
              $image->move($destinationPath, $primaryname);
            }else{
               $primaryname =  $c_profile->primary_logo;
            }
        if($request->file('logo') != '')
            {
              $image = $request->file('logo');

              $imagePath = public_path('/uploads/Companyprofile'.$image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                } 

              $logoname = time().'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/uploads/Companyprofile');
              $image->move($destinationPath, $logoname);
            }else{
               $logoname =  $c_profile->logo;
            }
        if($request->file('favicon_logo') != '')
            {
              $image = $request->file('favicon_logo');

              $imagePath = public_path('/uploads/Companyprofile'.$image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                } 
              $faviconname = time().'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/uploads/Companyprofile');
              $image->move($destinationPath, $faviconname);
            }else{
               $faviconname =  $c_profile->favicon_logo;
            }
            

        
        $c_profile->company_name = $request->company_name;
        $c_profile->company_email = $request->company_email;
        $c_profile->hr_email = $request->hr_email;
        $c_profile->address = $request->address;
        $c_profile->mobile_no = $request->mobile_no;
        $c_profile->website_url = $request->website_url;
        $c_profile->p_tax = $request->p_tax;
        $c_profile->skype_url = $request->skype_url;
        $c_profile->linkedin_url = $request->linkedin_url;
         $c_profile->instagram_url = $request->instagram_url;
        $c_profile->since_year = $request->since_year;
        $c_profile->primary_logo = $primaryname;
        $c_profile->logo = $logoname;
        $c_profile->favicon_logo = $faviconname;
         
        
        $c_profile->save();
              
               
         $status = 'true';
         $message = 'Data Update Successfully.';

        return response()->json(compact('status','message'));
       
}

}
