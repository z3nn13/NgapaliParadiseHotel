<div>
    <!------- User Table Start ------->
    <section class="table__wrapper container__admin-dashboard">
        <div class="table__container">
            <table class="table">
                <div class="table__title-bar">
                    <h2 class="table__caption">Users</h2>
                    <div class="table__options">
                        <div class="table__option table__option--filter">
                            <p>Filters</p>
                            <img src="{{ asset('images/svgs/table-filter.svg') }}">
                        </div>
                        <input class="table__option table__option--search"
                            name="user_search"
                            type="search"
                            spellcheck="false"
                            wire:model.debounce.300ms="searchQuery"
                            placeholder="Search User">
                    </div>
                </div>

                <!------- Table Head ------->
                <thead class="table__head"
                    x-data="{ sortDirection: @entangle('sortDirection'), sortField: @entangle('sortField') }">
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="id">User ID</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="first_name">Name</x-sortable-table-heading>


                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="role_id">Role</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="email">Email</x-sortable-table-heading>
                    <x-sortable-table-heading :sortDirection="$sortDirection"
                        sortField="phone_no">Phone Number</x-sortable-table-heading>

                    <th class="table__heading">Actions</th>
                </thead>


                <!------- Table Body ------->
                <tbody class="table__body">
                    @forelse  ($users as $user)
                        <x-user-table-row :user=$user></x-user-table-row>
                    @empty
                        <td class="table__cell">No Results Found.</td>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!------- Table Pagination ------->
        <div class="table__pagination">
            {{ $users->onEachSide(1)->links('livewire.livewire-pagination-links') }}
        </div>
    </section>
    <!------- User Table End ------->
</div>

@section('scripts')
    <script>
        function confirmDeleteUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteUser', userId);
                }
            });
        }
    </script>
@endsection
