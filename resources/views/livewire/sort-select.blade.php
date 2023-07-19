<div class="result-section__box result-section__box--sort">
    <select wire:model="selectedSortOption" wire:change="optionSelected"
        class="result-section__select result-section__select--sort" name="sortSelectValue" id="sortSelectValue">
        <option value="" disabled selected hidden>Sort By</option>
        <option value="desc">
            Price: High to Low
        </option>
        <option value="asc">
            Price: Low to High</option>
    </select>
</div>
