@props(['label', 'name', 'type'])
<div class="auth-input__field">
    <label class="auth-input__label"
        for="{{ $name }}"></label>
    <input class="auth-input__input"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) }}"
        placeholder="{{ $slot }}"
        required>
    @error($name)
        <p class="auth-input__error">{{ $message }}</p>
    @enderror
</div>
