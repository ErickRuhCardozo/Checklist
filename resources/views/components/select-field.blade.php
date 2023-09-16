<div {{ $attributes->merge(['class' => 'form-floating']) }}>
    <select class="form-select" id="{{ $name }}Field" name="{{ $name }}" @if ($required) required @endif>
        <option class="d-none" value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option
                value="{{ $option['value'] }}"
                @if ($option['label'] == $selectedLabel || $option['value'] == $selectedValue)
                    selected
                @endif>{{ $option['label'] }}</option>
        @endforeach
    </select>
    <label for="{{ $name }}Field">
        <i class="bi bi-{{ $icon }} me-1"></i>
        <span>{{ $label }}</span>
    </label>
</div>

