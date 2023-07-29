@props(['sortField', 'sortDirection'])
<th
    class="table__heading"
    wire:click="sortBy('{{ $sortField }}')"
    :class="{ 'table__heading--active': sortField === '{{ $sortField }}' }"
>
    <div class="table__heading--sortable">
        {{ $slot }}
        <x-table-sort-arrow
            :sortDirection="$sortDirection"
            sortField="{{ $sortField }}"
        />
    </div>
</th>
