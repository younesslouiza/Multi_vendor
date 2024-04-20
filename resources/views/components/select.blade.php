@props([
    'name', 'options', 'label' => '', 'value' => '','selected'
])

@if($label)
<label class="form-label">{{ $label }}</label>
@endif

<select name="{{ $name }}" 
        {{ $attributes->class
        (['form-control', 
        'is-invalid'
         => $errors->has($name)]) }}
>

    @foreach($options as $value => $text)
    <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach
</select>

<x-form.error :name="$name" />