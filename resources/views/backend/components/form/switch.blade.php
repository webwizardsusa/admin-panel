@props([
    'name' => '',
    'class' => '',
    'checked' => false,
])

<div class="form-check form-switch m-1 d-flex">
    {{ html()->checkbox($name, $checked, 1)->class(['form-check-input', $class])->style("width:50px;height:30px;") }}
</div>



