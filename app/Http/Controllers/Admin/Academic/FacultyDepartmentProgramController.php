<?php

namespace App\Http\Controllers\Admin\Academic;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacultyDepartmentProgramController extends Controller
{
    /**
     * ******************************************************
     * Faculty information related functions
     * ******************************************************
     */
    public function facultyList(): JsonResponse
    {
        try {
            $faculty_list = Faculty::all();
            return \response()->json(['faculty_list' => $faculty_list]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNewFaculty(Request $request): JsonResponse
    {
        try {
            $faculty = Faculty::create($request->all());
            return \response()->json(['faculty' => $faculty, 'message' => 'New faculty information added to the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateFaculty(Request $request, Faculty $faculty): JsonResponse
    {
        try {
            $faculty->update($request->all());
            return \response()->json(['message' => 'Faculty information updated in the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeFaculty(Faculty $faculty): JsonResponse
    {
        try {
            $faculty->delete();
            return \response()->json(['message' => 'Faculty information removed from the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * ******************************************************
     * Department information related functions
     * ******************************************************
     */
    public function departmentList(): JsonResponse
    {
        try {
            $faculty_list = Faculty::all();
            return \response()->json(['faculty_list' => $faculty_list]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNewDepartment(Request $request): JsonResponse
    {
        try {
            $department = Department::create($request->all());
            return \response()->json(['department' => $department, 'message' => 'New department information added to the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateDepartment(Request $request, Department $department): JsonResponse
    {
        try {
            $department->update($request->all());
            return \response()->json(['message' => 'Department information updated in the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeDepartment(Department $department): JsonResponse
    {
        try {
            $department->delete();
            return \response()->json(['message' => 'Faculty information removed from the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * ******************************************************
     * Program information related functions
     * ******************************************************
     */
    public function programList(): JsonResponse
    {
        try {
            $faculty_list = Faculty::all();
            return \response()->json(['faculty_list' => $faculty_list]);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNewProgram(Request $request): JsonResponse
    {
        try {
            $program = Program::create($request->all());
            return \response()->json(['program' => $program, 'message' => 'New program information added to the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateProgram(Request $request, Program $program): JsonResponse
    {
        try {
            $program->update($request->all());
            return \response()->json(['message' => 'Program information updated in the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeProgram(Program $program): JsonResponse
    {
        try {
            $program->delete();
            return \response()->json(['message' => 'Faculty information removed from the system.']);
        } catch (\Throwable $throwable) {
            return response()->json(['message' => $throwable->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
