<x-backend.layouts.full>
    <x-backend::ui.breadcrumb 
        title="Edit Customer"
        :crumbs="[
            ['title' => 'Customers List', 'link' => baseURL('customer')],
            ['title' => 'Edit Customer']
        ]"
    />
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            {{ html()->form('put', baseURL("customer/{$id}"))->open() }}
                @include('backend.customer.partials.form', ['record' => $record])
            {{ html()->form()->close() }}
        </div>
    </div>
</x-backend.layouts.full>