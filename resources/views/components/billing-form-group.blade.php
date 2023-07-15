<div class="billing-form__group">
    <label for="{{ $attributes['id'] }}" class="billing-form__label">{{ $slot }}</label>
    <input {{ $attributes->merge(['class' => 'billing-form__input', 'required' => 'required']) }}>
</div>
