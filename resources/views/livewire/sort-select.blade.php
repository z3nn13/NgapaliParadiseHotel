<div class="result-section__box result-section__box--sort"
    wire:ignore>
    <select class="result-section__select result-section__select--sort"
        id="sortSelect">
        <option selected
            hidden></option>
        <option value="desc">High to Low</option>
        <option value="asc">Low to High</option>
    </select>

    <script type="module">
        $(function() {
            $('#sortSelect').on('change', function(e) {
                var data = $('#sortSelect').select2("val");
                console.log(data)
                @this.set('selectedSortOption', data);
            });
        });


        $("#sortSelect").select2({
            placeholder: "Sort By Price: ",
            minimumResultsForSearch: 6,
            width: '100%',
            dropdownCssClass: "result-section__select-dropdown",
        });
    </script>
</div>
