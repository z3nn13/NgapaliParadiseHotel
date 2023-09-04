<div class="billing-form__group">
    <label class="billing-form__group-label"
        for="{{ $name }}">
        {{ $slot }}
    </label>
    <input {{ $attributes->merge([
        'class' => 'billing-form__group-input',
        'required' => 'required',
        'name' => $name,
        'wire:model' => $name,
    ]) }}>
    @error($name)
        <span class="auth-input__error">{{ $message }}</span>
    @enderror
</div>
