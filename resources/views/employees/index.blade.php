@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Department</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->firstname }}</td>
                    <td>{{ $employee->lastname }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Status Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Total Employees</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statusSummary as $status => $count)
                <tr>
                    <td>{{ $status }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Grand Total</th>
                <th>{{ $grandTotal }}</th>
            </tr>
        </tfoot>
    </table>

    <h2>Department Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Dept</th>
                <th>Contract</th>
                <th>Employee</th>
                <th>Not Active</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departmentSummary as $deptId => $deptTotals)
                <tr>
                    <td>{{ $deptTotals['department']->name }}</td>
                    <td>{{ $deptTotals['contract'] ?? 0 }}</td>
                    <td>{{ $deptTotals['employee'] ?? 0 }}</td>
                    <td>{{ $deptTotals['not_active'] ?? 0 }}</td>
                    <td>{{ $deptTotals['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Grand Total</th>
                <th>{{ $grandTotals['contract'] }}</th>
                <th>{{ $grandTotals['employee'] }}</th>
                <th>{{ $grandTotals['not_active'] }}</th>
                <th>{{ $grandTotals['total'] }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
