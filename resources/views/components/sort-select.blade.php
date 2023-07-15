@props(['roomTypes', 'sortSelectValue'])
<div class="result-section__box result-section__box--sort">
    <form action="{{ route('room-types.sort') }}" method="POST">
        @csrf
        <input type="hidden" name="roomTypes" value="{{ json_encode($roomTypes) }}">
        <select onchange="this.form.submit()" class="result-section__select result-section__select--sort"
            name="sortSelectValue" id="sortSelectValue">
            <option value="" disabled selected hidden>Sort By</option>
            <option value="asc" @if (isset($sortSelectValue) && $sortSelectValue == 'asc') selected @endif>
                Price: High to Low
            </option>
            <option value="desc" @if (isset($sortSelectValue) && $sortSelectValue == 'desc') selected @endif>
                Price: Low to High</option>
        </select>
    </form>
</div>
{{-- <select class="result-section__select result-section__select--sort" name="sortSelect" id="sortSelect"
        data-room-types="{{ json_encode($roomTypes) }}"> --}}
