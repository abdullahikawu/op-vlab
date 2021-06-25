<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use App\Mail\forgotPasswordMail;
use Illuminate\Support\Facades\Mail;
class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        $sendLink = Password::sendResetLink($credentials);

        if ($sendLink == Password::INVALID_USER) {
            return response()->json(["msg" => 'Email not found.']);
        } else if ($sendLink == Password::INVALID_TOKEN) {
            return response()->json(["msg" => 'Invalid token.']);
        } else if ($sendLink == Password::RESET_THROTTLED) {
            return response()->json(["msg" => 'Wait for some minutes.']);
        }

        return response()->json(["msg" => 'Reset password link has been sent to your email address.']);
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|email',
            'token' => 'required|string',           
        ]);
        if (!$validator->fails()) {                                    
            return redirect()->back()->with(['status'=>400, 'msg'=>'All Fields Are Required']);
        }

        $datedel = today()->format('Y-m-d'); 
        $token = $request->get('token');
        $password = md5($request->get('password'));

        $passwordtbl = PasswordReset::where(['token'=>$token, 'created_at'=> $datedel])->first();
        if (is_null($passwordtbl)) {
            return redirect()->back()->with(['status'=>409,'msg'=>'Reset link has expired']);
        }else{
            $email = $passwordtbl->email;
            User::where(['email'=>$email])->update(['password'=>$password]);
            PasswordReset::where('email','=', $email)->delete();           
            return redirect()->back()->with(['status'=>200,'msg'=>'password reset successfully']);       
        }

    }
    public function save_token(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',           
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status'=>400, 'msg'=>'all field required']);
        }
        $email = $request->get('email');
        $token = $request->get('token');
        $user = User::where('email',$email)->first();        
        if (is_null($user)) {
            return redirect()->back()->with(["status" => 409, 'msg'=>'invalid email']);                    
        }else{
            $datedel = today()->format('Y-m-d'); 
            $toDelete = PasswordReset::where('created_at','!=', $datedel)->delete();            
            DB::table('password_resets')->where(['email'=>$email])->delete();
            DB::table('password_resets')->insert([
                'email'=> $email,
                'token' => $token,            
                'created_at'=>$datedel,
            ]);            
            session(['forgot_password_token'=> $token]);
            Mail::to($email)->send(new forgotPasswordMail());                    
            return redirect()->back()->with(["status"=> 200,'msg'=>'Reset password link has been sent to your email address.']);        
        }
    }
    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        $credentials = $request->all();

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = md5($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}
