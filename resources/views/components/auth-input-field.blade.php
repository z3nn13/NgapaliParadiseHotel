@props(['label', 'name', 'type'])
<div class="auth-input__field">
    <label class="auth-input__label" for="{{ $name }}"></label>
    <input class="auth-input__input" placeholder="{{ $slot }}" type="{{ $type }}"
        name="{{ $name }}">
    @error($name)
        <p class="auth-input__error">{{ $message }}</p>
    @enderror
</div>
