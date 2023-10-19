<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Types;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OTP;
use App\Traits\SmsServiceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use SmsServiceTrait;

    public function generateOtp(Request $request): JsonResponse
    {
        try {
            if ($request->input('user_type') === Types::Admin->value) {
                $admin = Admin::where('username', $request->input('username'))->first();
                if ($admin) {
                    $otp = OTP::create(['user_type' => $request->input('user_type'), 'user_id' => $admin->id, 'otp' => random_int(111111, 999999)]);
//                    $this->sendSms($admin->phone, 'Your password change OTP: ' . $otp->otp);
                    return \response()->json(['otp' => $otp, 'message' => 'OTP has been sent to your phone number, please check and follow the second step.']);
                }
                return response()->json(['message' => 'User not found!'], Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
            }
            return response()->json(['message' => 'Invalid User Type!'], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePassword(Request $request): JsonResponse
    {
        try {
            $otp = OTP::where('otp', $request->input('otp'))->first();
            if ($otp && $otp->user_type === Types::Admin->value) {
                Admin::where('id', $otp->user_id)->update([
                    'password' => Hash::make($request->input('password'))
                ]);
                $otp->delete();
                return \response()->json(['message' => 'Password updated successfully, please login with your new password.']);
            }
            return response()->json(['message' => 'Invalid Operation'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            if ($request->input('user_type') === Types::Admin->value) {
                $admin = Admin::where('username', $request->input('username'))->first();
                if ($admin && Hash::check($request->input('password'), $admin->password)) {
                    $token = $admin->createToken('auth_token')->plainTextToken;
                    return \response()->json(['status' => Response::HTTP_OK, 'admin' => $admin, 'auth_token' => $token]);
                }
                return response()->json(['status' => Response::HTTP_UNAUTHORIZED, 'message' => 'Invalid username or Password!']);
            }
            return response()->json(['status' => Response::HTTP_UNAUTHORIZED, 'message' => 'Unauthorized user type.']);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkAuthentication(): JsonResponse
    {
        try {
            return \response()->json(['status' => Response::HTTP_OK, 'message' => 'user authenticated']);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => $throwable->getMessage()]);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return \response()->json(['message' => 'User logged out successfully.']);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
