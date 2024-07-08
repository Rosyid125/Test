@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('employees.form', ['employee' => $employee])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
