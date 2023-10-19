<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Enums\Types;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ApplicationSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationSettingsController extends Controller
{
    public function getApplicationSettings(): JsonResponse
    {
        try {
            $application_settings = ApplicationSetting::first();
            return \response()->json(['application_settings' => $application_settings]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function applicationSettings(Request $request): JsonResponse
    {
        try {
            ApplicationSetting::create($request->all());
            return \response()->json(['message' => 'Application settings are set.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function checkSuperUserExistence():JsonResponse {
        try {
            $super_user = Admin::where('type',Types::Super)->exists();
            if ($super_user){
                return \response()->json(['message' => true]);
            }
            return \response()->json(['message' => false]);
        }catch (\Throwable $throwable){
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
