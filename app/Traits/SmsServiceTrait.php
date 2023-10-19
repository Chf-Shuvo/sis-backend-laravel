<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

trait SmsServiceTrait
{
    public function sendSms($number, $content): JsonResponse
    {
        try {
//            $response = Http::post('https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2', [
//                "username" => "mpunitadmin",
//                "password" => "Baiust123@",
//                "apicode" => "1",
//                "msisdn" => $number,
//                "countrycode" => "880",
//                "cli" => "BAIUST",
//                "messagetype" => "1",
//                "message" => $content,
//                "messageid" => "0"
//            ]);
            return response()->json(['message' => $response]);
        } catch (\Throwable$throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
