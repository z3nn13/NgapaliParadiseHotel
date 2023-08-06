@props(['active', 'title' => 'Admin'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>{{ $title }} | Ngapali Paradise Hotel</title>


    <!-- Cdns -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com"
        rel="preconnect">
    <link href="https://fonts.gstatic.com"
        rel="preconnect"
        crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Sacramento&family=Newsreader:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
    @livewireStyles

</head>

<body class="admin">

    <!-- Main Content -->
    <x-admin-nav :active=$active>
        {{ $slot }}
    </x-admin-nav>


    @livewireScripts
    @livewire('livewire-ui-modal')

    <!-- Scripts -->
    @yield('scripts')
    <script>
        Livewire.on('dataChanged', (dataName, dataId, action) => {
            const capitalizedAction = action.charAt(0).toUpperCase() + action.slice(1);
            const paddedDataId = dataId.toString().padStart(4, '0');

            Swal.fire(
                capitalizedAction + '!',
                `${dataName} ID #${paddedDataId} has been ${action} successfully.`,
                'success'
            )
        });
    </script>
</body>

</html>
