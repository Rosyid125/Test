<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        
        // hitung status summary
        $statusSummary = Employee::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
    
        // hitung grand total
        $grandTotal = $employees->count();
    
        // hitung department summary
        $departmentSummary = Employee::select('dept_id', 'status', DB::raw('count(*) as total'))
            ->groupBy('dept_id', 'status')
            ->get()
            ->groupBy('dept_id')
            ->map(function ($item) {
                return [
                    'department' => Department::find($item[0]->dept_id),
                    'contract' => $item->where('status', 'cont')->sum('total'),
                    'employee' => $item->where('status', 'emp')->sum('total'),
                    'not_active' => $item->where('status', 'not_act')->sum('total'),
                    'total' => $item->sum('total'),
                ];
            });

            // hitung grand total untuk setiap kolom hehe
        $grandTotals = [
            'contract' => $departmentSummary->sum('contract'),
            'employee' => $departmentSummary->sum('employee'),
            'not_active' => $departmentSummary->sum('not_active'),
            'total' => $departmentSummary->sum('total'),
        ];
    
        return view('employees.index', compact('employees', 'statusSummary', 'grandTotal', 'departmentSummary', 'grandTotals'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:100',
            'dob' => 'required|date',
            'dept_id' => 'required|exists:departments,id',
            'status' => 'required|in:cont,emp,not_act',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:100',
            'dob' => 'required|date',
            'dept_id' => 'required|exists:departments,id',
            'status' => 'required|in:cont,emp,not_act',
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function summary_status()
    {
        $employees = Employee::all();
        return view('employees.summary_status', compact('employees'));
    }
}

