<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $fillable = [
        'name',
        'departmentId',
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }

    public function spendings()
    {
        return $this->hasMany(Spendings::class, 'employeeId', 'id');
    }

    public function getAllEmployees()
    {
        $employees = Employee::with('departments')->get();
        return $employees;
    }
}
