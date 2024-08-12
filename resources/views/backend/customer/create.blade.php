@extends('backend.layouts.full')

@section('content')
    <x-backend::ui.breadcrumb 
        title="Create Customer"
        :crumbs="[
            ['title' => 'Customers List', 'link' => baseURL('customer')],
            ['title' => 'Create Customer']
        ]"
    />
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            {{ html()->form('post', baseURL('customer'))->open() }}
                @include('backend.customer.partials.form')
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection