<?php

namespace App\Http\Controllers;

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
        foreach ($spendings as $spending) {
            $spending->date = Carbon::parse($spending->date)->format('d-F-YY');
        }
        return view('components.spending', ['spendings' => $spendings]);
    }
}
