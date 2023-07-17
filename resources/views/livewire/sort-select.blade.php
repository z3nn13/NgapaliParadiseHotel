<div class="result-section__box result-section__box--sort">
    <form action="{{ route('room-types.sort') }}" method="POST">
        @csrf
        <input type="hidden" name="roomTypes" value="{{ json_encode($roomTypes) }}">
        <select onchange="this.form.submit()" class="result-section__select result-section__select--sort"
            name="sortSelectValue" id="sortSelectValue">
            <option value="" disabled selected hidden>Sort By</option>
            <option value="desc">

                Price: High to Low
            </option>
            <option value="asc">
                Price: Low to High</option>
        </select>
    </form>
</div>
