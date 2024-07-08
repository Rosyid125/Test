<div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $employee->firstname ?? '') }}" required>
</div>
<div class="form-group">
    <label for="lastname">Last Name</label>
    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $employee->lastname ?? '') }}" required>
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select class="form-control" id="gender" name="gender" required>
        <option value="male" {{ old('gender', $employee->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender', $employee->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
    </select>
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employee->address ?? '') }}" required>
</div>
<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $employee->dob ?? '') }}" required>
</div>
<div class="form-group">
    <label for="dept_id">Department</label>
    <select class="form-control" id="dept_id" name="dept_id" required>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('dept_id', $employee->dept_id ?? '') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="cont" {{ old('status', $employee->status ?? '') == 'cont' ? 'selected' : '' }}>Contract</option>
        <option value="emp" {{ old('status', $employee->status ?? '') == 'emp' ? 'selected' : '' }}>Employee</option>
        <option value="not_act" {{ old('status', $employee->status ?? '') == 'not_act' ? 'selected' : '' }}>Not Active</option>
    </select>
</div>
