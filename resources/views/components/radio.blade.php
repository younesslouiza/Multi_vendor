

@props(['name', 'label', 'options', 'checked'])

<div>
    <label for="{{ $name }}">{{ $label }}</label>
    
    @foreach($options as $value => $optionLabel)
        <div>
            <input type="radio" id="{{ $name . '_' . $value }}" name="{{ $name }}" value="{{ $value }}" 
                   {{ $value == $checked ? 'checked' : '' }}
                   {{ $attributes }}>
            <label for="{{ $name . '_' . $value }}">{{ $optionLabel }}</label>
        </div>
    @endforeach
</div>
