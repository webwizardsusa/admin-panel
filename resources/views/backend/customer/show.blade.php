@extends('backend.layouts.full')

@section('content')
    @php
        $name = $record['name'];
        $email = $record['email'];
        $mobile = $record['mobile'];
        $dob = $record['dob'] ? dateFormat(3, $record['dob']) : '';
        $gender = lists('gender')[$record['gender']] ?? '';
        $status = lists('status')[$record['status']] ?? '';
    @endphp

    <x-backend::ui.breadcrumb 
        title="View Customer"
        :crumbs="[
            ['title' => 'Customers List', 'link' => baseURL('customer')],
            ['title' => 'View Customer']
        ]"
    />
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="detail-view">
                <div class="col-md-12">
                    <label>Name</label>
                    <p>{{ $name }}</p>
                </div>
                <div class="col-md-12">
                    <label>Email</label>
                    <p>{{ $email }}</p>
                </div>
                <div class="col-md-12">
                    <label>Mobile</label>
                    <p>{{ $mobile }}</p>
                </div>
                <div class="col-md-12">
                    <label>Date of Birth</label>
                    <p>{{ $dob }}</p>
                </div>
                <div class="col-md-12">
                    <label>Gender</label>
                    <p>{{ $gender }}</p>
                </div>
                <div class="col-md-12">
                    <label>Status</label>
                    <p>{{ $status }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

