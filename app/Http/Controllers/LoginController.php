<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
use App\Models\EmployeeModel;
use stdClass;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
     public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public  function Login(Request $request)
    {

        $session = session('user_type');
        if(isset($session)){
            if($session == 'admin'){
                 return redirect('admin/dashboard');
            }else{
                 return redirect('employee/dashboard');
            }
        }
        if($request->isMethod('post'))
        {
           
            $user = DB::table('employee')->where('email',$request->email)->first();

            if(!empty($user)) {

                if($user->status==0){
                    return redirect()->back()->withInput()->with('autherror', 'Seem\'s like you are not active for further access, Please contact with your administrator.');
                }
                if(! Hash::check($request->password,$user->password))
                {
                    return redirect()->back()->withInput()->with('autherror', 'Password is not correct.');
                }
                
                $user_data = New stdClass();
                $user_data->id = $user->id;
                $user_data->name = $user->first_name . ' ' . $user->last_name;
                $user_data->department_id = $user->department_id;
                $user_data->image = $user->image;

                
                Session::put('user_data',$user_data);
                
                if($request->rememberme===null){
                    setcookie('login_email',$request->email,100);
                    setcookie('login_pass',$request->password,100);
                 }
                 else{
                    setcookie('login_email',$request->email,time()+60*60*24*100);
                    setcookie('login_pass',$request->password,time()+60*60*24*100);
     
                 }
               
                if($user->user_type == "admin" && $user->department_id == 1){
                    Session::put('user_type','admin');
                     return redirect('admin/dashboard');
                }
                if($user->user_type == "user" && $user->department_id == 1)
                {
                    Session::put('user_type',$user->department_id);
                    return redirect('admin/dashboard');
                }
                else
                {
                    Session::put('user_type',$user->department_id);
                    return redirect('employee/dashboard');
                }
           
            }
            else {
                 return redirect()->back()->withInput()->with('autherror', 'Email is not found.');
            }   
        
          
        }
        else
        {
            return view('login');   
        }
    }

    public function forgot_password(Request $request)
    {
        if($request->isMethod('post'))
        {
         $user = DB::table('employee')->where('email',$request->email)->first();
            
            if(!empty($user)) {
                $name = $user->first_name.' '.$user->last_name;
                
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $length = 20;
                $token = '';
                for ($i = 0; $i < $length; $i++) {
                    $token .= $characters[rand(0, $charactersLength - 1)];
                }
                
                $updateToken = DB::table('employee')->where('email',$request->email)->update(['forgot_pass_token'=>$token]);
                
                $data = array('name'=>$name,'token'=>$token);
                
                $mailData = array(
                    'to' => $user->email,
                    'subject' => 'Reset Password',
                    'message' => view('mail.forgot_password',compact('data'))
                );
                
                sendMail($mailData);
                
                return redirect()->back()->with('reset', 'Please check your email for reset password.');
            }else{
                return redirect()->back()->with('autherror', 'Email is not found.');
            }
        }
        return view('forgot_password');
    }
    
    public function reset_password(Request $request,$token)
    {
        if($request->isMethod('post'))
        {
             if($request->isMethod('post'))
            {
                 $validator = Validator::make($request->all(), [
                  'password' => 'required|confirmed|min:6'
                ]);
             if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
                //return redirect()->back()->withInput()->with('error', 'Password and confirm password does not match.');
            }
            
            $check = DB::table('employee')->where('forgot_pass_token',$token)->count();
            if($check > 0) {
                $updatePassword = DB::table('employee')->where('forgot_pass_token',$token)->update(['password'=>Hash::make($request->password),'forgot_pass_token'=>'']);
                
                return redirect('login')->with('reset','Password changed successfully. Please login with your new password');
            }else {
                return redirect()->back()->with('error','Something went wrong');
                }
            }
        }
        else
        {
            $check = DB::table('employee')->where('forgot_pass_token',$token)->count();
            if($check == 0) {
                return redirect('login')->with('autherror','Reset password link has been expired. Please request a new reset password link and try again');
            }
            return view('reset_password',compact('token'));
       
        }
    }
    public function logout()
    {
         Session::flush();
        $sess = session('user_data');

        if(!empty($sess))
        {
            
            session_start();
            session_destroy();
           
        }
               
        return redirect('login');
        /*Session::forget('email');
        if( isset($_SESSION['email']) ) 
        {
            return redirect('login');
        }
        else 
        {
              return redirect('login');
        }*/
    }

    public function employlogout()
    {

    }
}

