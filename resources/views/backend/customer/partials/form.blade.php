@php
    $record = $record ?? [];
    $name = $record['name'] ?? old('name');
    $email = $record['email'] ?? old('email');
    $mobile = $record['mobile'] ?? old('mobile');
    $dob = isset($record['dob']) ? dateFormat(3, $record['dob']) : old('dob');
    $gender = $record['gender'] ?? old('gender');
    $status = $record['status'] ?? old('status');
@endphp

<div class="row g-3">
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <x-backend::form.input name="name" placeholder="Enter Name" value="{{ $name }}"/>
        <x-backend::form.error name="name" :errors="$errors"/>
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <x-backend::form.input name="email" placeholder="Enter Email" value="{{ $email }}"/>
        <x-backend::form.error name="email" :errors="$errors"/>
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <x-backend::form.input type="password" name="password" placeholder="Enter Password" value=""/>
        <x-backend::form.error name="password" :errors="$errors"/>
    </div>
    <div class="col-md-6">
        <label for="mobile" class="form-label">Mobile Number</label>
        <x-backend::form.input name="mobile" placeholder="Enter Mobile Number" value="{{ $mobile }}"/>
        <x-backend::form.error name="mobile" :errors="$errors"/>
    </div>
    <div class="col-md-6">
        <label for="dob" class="form-label">Date of Birth</label>
        <x-backend::form.datepicker name="dob" placeholder="Enter Date of Birth" value="{{ $dob }}"/>
    </div>
    <div class="col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <x-backend::form.select 
            name="gender" 
            value="{{ $gender }}"
            :options="lists('gender')"
        />
        <x-backend::form.error name="gender" :errors="$errors"/>
    </div>
    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <x-backend::form.switch name="status" checked="{{ switches($status, 2, 1) }}"/>
        <x-backend::form.error name="status" :errors="$errors"/>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>