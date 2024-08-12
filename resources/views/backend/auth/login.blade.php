@extends('backend.layouts.blank')

@section('content')
    <p class="mb-7">Please sign in to access the dashboard.</p>
    <x-backend::ui.alerts />
    {{ html()->form('post', baseURL())->open() }}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <x-backend::form.input name="email" placeholder="Enter Email" value="{{ old('email') }}"/>
            <x-backend::form.error name="email" :errors="$errors"/>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <x-backend::form.input type="password" name="password" placeholder="Enter Password" value=""/>
            <x-backend::form.error name="password" :errors="$errors"/>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
    {{ html()->form()->close() }}
    <div class="col-12">
        <h4>Admin Credentials</h4>
        <p class="mb-1">Email: admin@admin.com</p>
        <p>Password: 123456</p>
    </div>
@endsection