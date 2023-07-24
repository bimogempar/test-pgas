<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SpendingExport;
use App\Models\Spending;
use Carbon\Carbon;

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
        foreach ($spendings as $spending) {
            $spending->date = Carbon::parse($spending->date)->format('d-F-Y');
        }
        return view('components.spending', ['spendings' => $spendings]);
    }

    public function getExportSpending()
    {
        return Excel::download(new SpendingExport(), 'spending.xlsx');
    }
}
