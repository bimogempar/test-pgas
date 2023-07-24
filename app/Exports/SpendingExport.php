<?php

namespace App\Exports;

use App\Models\Spending;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SpendingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch the data you want to export (e.g., list of Spending)
        $spendings = Spending::with('employees')->orderBy('date', 'asc');
        $spendings = $spendings->get();
        foreach ($spendings as $spending) {
            $spending->employeeId = $spending->employees->name;
            $spending->date = Carbon::parse($spending->date)->format('d-F-Y');
        }
        return $spendings;
    }

    public function headings(): array
    {
        // Define the headings for the Excel columns
        return [
            'ID',
            'Employee',
            'Date',
            'Value',
            // Add more headings as needed
        ];
    }
}
