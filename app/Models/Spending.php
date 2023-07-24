<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    protected $table = 'spending';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employeeId', 'id');
    }

    public function getSpendings()
    {
        $spendings = Spending::with('employees')->get();
        return $spendings;
    }
}
