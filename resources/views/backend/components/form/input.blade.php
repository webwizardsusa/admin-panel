@props([
    'type' => 'text',
    'name' => '',
    'class' => '',
    'placeholder' => '',
    'value' => '',
])

{{ html()->input($type, $name, $value)->class(['form-control', $class])->placeholder($placeholder) }}