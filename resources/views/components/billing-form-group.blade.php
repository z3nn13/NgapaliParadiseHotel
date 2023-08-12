<div class="billing-form__group">
    <label class="billing-form__group-label"
        for="{{ $attributes['id'] }}">
        {{ $slot }}
    </label>
    <input value="{{ auth()->check() ? auth()->user()->$name : old($name) }}"
        {{ $attributes->merge([
            'class' => 'billing-form__group-input',
            'required' => 'required',
            'name' => $name,
            'readonly' => auth()->check(),
        ]) }}>
</div>
