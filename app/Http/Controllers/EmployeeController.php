<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $emp;
    protected $dept;

    public function __construct()
    {
        $this->emp = new Employee();
        $this->dept = new Department();
    }

    public function getEmployee(Request $request)
    {
        $employees = Employee::with('departments');
        $departments = $this->dept->getDepartments();
        $deptId = "";
        $search = "";

        if ($request->query('dept_id') !== null) {
            $deptId = $request->query('dept_id');
            $employees->where(function ($dept) use ($deptId) {
                $dept->whereHas('departments', function ($q) use ($deptId) {
                    $q->where('id', $deptId);
                });
            });
        }

        if ($request->query('search') !== null) {
            $search = $request->query('search');
            $employees->where('name', 'ilike', '%' . $search . '%')
                ->orWhere(function ($dept) use ($search) {
                    $dept->whereHas('departments', function ($q) use ($search) {
                        $q->where('name', 'ilike', '%' . $search . '%');
                    });
                });
        }

        $employees = $employees->orderBy('updated_at', 'asc')->get();
        return view('components.employee', compact('employees', 'departments', 'deptId', 'search'));
    }

    public function doDeleteEmployee($empId)
    {
        $emp = Employee::find($empId);
        if (!$emp) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }
        $emp->delete();
        return response()->json(['message' => 'Employee deleted successfully.'], 200);
    }

    public function doUpdateEmpEmployee($empId, Request $request)
    {
        $emp = Employee::find($empId);

        if (!$emp) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        $input = $request->validate([
            'name' => 'required|string',
            'departmentId' => 'required',
        ]);

        $emp->name = $input['name'];
        $emp->departmentId = $input['departmentId'];
        $emp->save();
        return response()->json(['message' => 'Employee updated successfully.'], 200);
    }
}
