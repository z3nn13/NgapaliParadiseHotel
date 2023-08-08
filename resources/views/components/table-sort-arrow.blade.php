<!-- resources/views/livewire/x-table-sort-arrow.blade.php -->
@props(['sortDirection', 'sortField'])

<!-- Ascending arrow SVG -->
<svg class="sort__icon"
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    x-show="sortDirection === 'asc' && sortField === '{{ $sortField }}'"
    height="22"
    x-cloak
    viewBox="0 0 24 24">
    <path fill="none"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="m12 5l6 6m-6-6l-6 6m6-6v14" />
</svg>

<!-- Descending arrow SVG -->
<svg class="sort__icon"
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    viewBox="0 0 24 24"
    x-show="sortDirection === 'desc' && sortField === '{{ $sortField }}'"
    x-cloak>
    <!-- SVG path for the descending arrow -->
    <path fill="none"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="m12 19l6-6m-6 6l-6-6m6 6V5" />

</svg>

<!-- Default arrow SVG -->
<svg class="sort__icon"
    xmlns="http://www.w3.org/2000/svg"
    width="18"
    height="18"
    x-cloak
    x-show="!(sortDirection === 'asc' || sortDirection === 'desc') || sortField !== '{{ $sortField }}'"
    viewBox="0 0 24 24">
    <path fill="currentColor"
        d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414l4-4zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L16 16.586z" />
</svg>
