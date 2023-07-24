<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployee()
    {
        return view('components.employee');
    }
}
