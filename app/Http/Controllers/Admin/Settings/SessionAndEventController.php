<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionAndEventController extends Controller
{
    public function sessionList(): JsonResponse
    {
        try {
            $session_list = Session::orderBy('id', 'desc')->get();
            return \response()->json(['session_list' => $session_list]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNewSession(Request $request): JsonResponse
    {
        try {
            $session = Session::create($request->all());
            return \response()->json(['message' => 'New session added to the system.', 'session' => $session]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editSession(Session $session): JsonResponse
    {
        try {
            return \response()->json(['message' => 'Data fetched successfully.', 'session' => $session]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateSession(Request $request, Session $session): JsonResponse
    {
        try {
            $session->update($request->all());
            return \response()->json(['message' => 'Session updated successfully.', 'session' => $session]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eventTypeList(): JsonResponse
    {
        try {
            $list = EventType::all();
            return \response()->json(['event_list' => $list]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eventTypeAdd(Request $request): JsonResponse
    {
        try {
            EventType::create($request->all());
            return \response()->json(['message' => 'Event type added to the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
