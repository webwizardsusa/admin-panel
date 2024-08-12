@props([
    'name' => '',
    'class' => '',
    'placeholder' => '',
    'value' => '',
])

<div class="input-group">
    {{ html()->text($name, $value)->class(['form-control', $class])->placeholder($placeholder) }}
    <span class="input-group-text">
        <i class="ti ti-calendar fs-5"></i>
    </span>
</div>

@push('styles')
    @once
        <link rel="stylesheet" href="{{ url('assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
    @endonce
@endpush

@push('scripts')
    @once
        <script src="{{ url('assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script>
            function datepicker(selector) {
                $(selector).datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                });
            }
        </script>
    @endonce

    <script>
        $(function() {
            datepicker("[name='{{ $name }}']")
        })
    </script>
@endpush