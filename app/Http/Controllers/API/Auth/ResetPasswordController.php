<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        try {
            $user = User::find($request->user()->id);
            if(!Hash::check($request->old_password, $user->password)) {
                return ResponseFormatter::error([
                    'message' => 'old password is wrong'
                ], 'failed', 401);
            }
    
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return ResponseFormatter::success(
                $user, 
                'successfuly changed the password'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => 'someting went wrong',
                'error' => $e->getMessage(),
            ], 'reset password failed', 500);
        }
    }
}
