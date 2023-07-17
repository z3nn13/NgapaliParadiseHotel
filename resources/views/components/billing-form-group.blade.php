@props(['name'])
@auth
    <div class="billing-form__group">
        <label for="{{ $attributes['id'] }}" class="billing-form__group-label">{{ $slot }}</label>
        <input {{ $attributes->merge(['class' => 'billing-form__group-input', 'required' => 'required', 'name' => $name]) }}
            value="{{ auth()->user()->$name }}">
    </div>
@endauth

@guest
    <div class="billing-form__group">
        <label for="{{ $attributes['id'] }}" class="billing-form__group-label">{{ $slot }}</label>
        <input {{ $attributes->merge(['class' => 'billing-form__group-input', 'required' => 'required', 'name' => $name]) }}>
    </div>
@endguest
