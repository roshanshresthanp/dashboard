<?php

namespace App\Actions\Login;

use App\Actions\OTP\SendOtpAction;
use App\Models\OtpVerification;
use App\Models\User;
use App\Services\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Lorisleiva\Actions\Concerns\AsAction;

final class ResetPasswordAction
{
    // use AsAction;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
            DB::beginTransaction();
        try{
            $user = User::firstWhere('mobile',$this->request->mobile);
            $user->update(['password'=>bcrypt($this->request->new_password)]);
            $user->tokens()->delete();
            $success['message'] = 'Password has been changed';
            $success['token'] = $user->createToken('MobileAuthApp')->accessToken;
            DB::commit();

            return response()->json($success, 200);
        }catch(\Exception $e)
        {
            DB::rollBack();
            $success['message'] = 'Failed to change password';
            return response()->json($success, 400);
        }
        
    }
}
