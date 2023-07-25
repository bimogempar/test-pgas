<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SpendingExport;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    protected $spending;

    public function __construct()
    {
        $this->spending = new Spending();
    }

    public function getSpending()
    {
        $spendings = $this->spending->getSpendings();
        $departments = Department::get();
        $employees = Employee::get();
        foreach ($spendings as $spending) {
            $spending->date = Carbon::parse($spending->date)->format('d-F-Y');
        }
        return view('components.spending', compact('departments', 'spendings', 'employees'));
    }

    public function getExportSpending()
    {
        return Excel::download(new SpendingExport(), 'spending.xlsx');
    }

    public function doDeleteSpending($spendId)
    {
        $spend = Spending::find($spendId);

        if (!$spend) {
            return response()->json(['message' => 'Spending not found.'], 404);
        }

        $spend->delete();
        return response()->json(['message' => 'Spending deleted successfully.'], 200);
    }

    public function doUpdateSpending($spendId, Request $request)
    {
        $spend = Spending::find($spendId);

        if (!$spend) {
            return response()->json(['message' => 'Spending not found.'], 404);
        }

        $input = $request->validate([
            'spendId' => 'required',
            'empId' => 'required',
            'dateSpend' => 'required',
            'valueSpend' => 'required',
        ]);

        $spend->employeeId = intval($input['empId']);
        $spend->date = $input['dateSpend'];
        $spend->value = $input['valueSpend'];
        $spend->save();
        return response()->json(['message' => 'Spending updated successfully.'], 200);
    }
}
