@extends('backend.layouts.full')

@section('content')
    <x-backend::ui.breadcrumb 
        title="Customers"
        :crumbs="[
            ['title' => 'Customers List']
        ]"
    />
    <x-backend::ui.alerts />
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ baseURL('customer/create') }}" class="btn btn-dark">Create Customer</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <x-backend::datatable.table :dataTable="$dataTable"/>
            </div>
        </div>
    </div>
@endsection

