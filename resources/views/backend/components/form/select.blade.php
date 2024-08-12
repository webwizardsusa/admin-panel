<div class="col-12">
    @props([
        'name' => '',
        'class' => '',
        'value' => '',
        'options' => [],
        'optionsKey' => '',
        'optionsValue' => '',
    ])

    @if ($optionsKey != '' && $optionsValue != '')
        $options = array_column($options, $optionsValue, $optionsKey);
    @endif

    {{ html()->select($name, $options, $value)->class(['form-control', $class]) }}
</div>

@push('styles')
    @once
        <link rel="stylesheet" href="{{ url('assets/backend/plugins/select2/css/select2.min.css') }}" />
    @endonce
@endpush

@push('scripts')
    @once
        <script src="{{ url('assets/backend/plugins/select2/js/select2.min.js') }}"></script>
        <script>
            function select2(selector) {
                $(selector).select2();
            }
        </script>
    @endonce

    <script>
        $(function() {
            select2("[name='{{ $name }}']");
        })
    </script>
@endpush