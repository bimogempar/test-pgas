<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'departmentId', 'id');
    }

    public function getDepartments()
    {
        $departments = Department::with('employees')->orderBy('updated_at', 'asc')->get();
        return $departments;
    }
}
