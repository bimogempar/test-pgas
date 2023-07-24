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
}
