<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $depts;

    public function __construct()
    {
        $this->depts = new Department();
    }

    public function getDepartment()
    {
        $departments = $this->depts->getDepartments();
        return view('components.department', ['departments' => $departments]);
    }

    public function doDeleteDepartment($deptId)
    {
        $dept = Department::find($deptId);
        if (!$dept) {
            return response()->json(['message' => 'Department not found.'], 404);
        }
        $dept->delete();
        return response()->json(['message' => 'Department deleted successfully.'], 200);
    }

    public function doUpdateDepartment($deptId, Request $request)
    {
        $dept = Department::find($deptId);

        if (!$dept) {
            return response()->json(['message' => 'Department not found.'], 404);
        }

        $input = $request->validate([
            'name' => 'required|string',
        ]);

        $dept->name = $input['name'];
        $dept->save();
        return response()->json(['message' => 'Department updated successfully.'], 200);
    }
}
