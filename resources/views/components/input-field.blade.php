<div {{ $attributes->merge(['class' => 'form-floating']) }}>
    <input type="{{ $type }}" class="form-control @if (!empty($error)) is-invalid @endif" name="{{ $name }}" id="{{ $name }}Field" placeholder="{{ $label }}" value="{{ $value }}" @if ($required) required @endif @if ($readonly) readonly @endif @if ($focus) autofocus @endif>
    <label for="{{ $name }}Field">
        <i class="bi bi-{{ $icon }} me-1"></i>
        <span>{{ $label }}</span>
    </label>
    <div class="invalid-feedback">{{ $error }}</div>
</div>

