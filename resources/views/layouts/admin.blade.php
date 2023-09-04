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


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com"
        rel="preconnect">
    <link href="https://fonts.gstatic.com"
        rel="preconnect"
        crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Sacramento&family=Newsreader:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">



    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer
        src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
    @livewireStyles
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css"
        rel="stylesheet"
        integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />


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
        $(document).ready(function() {

            /* Notification Sweet Alert */
            $(window).on('swal:notification', function(event) {
                const detail = event.detail;
                Toast.fire({
                    text: detail.text,
                    icon: detail.type,
                });
            });

            $(window).on('swal:modal', function(event) {
                const detail = event.detail;
                Swal.fire({
                    title: detail.title,
                    text: detail.text,
                    icon: detail.type,
                });
            });

            $(window).on('swal:confirm', function(event) {
                const detail = event.detail;
                Swal.fire({
                    title: detail.title,
                    text: detail.text,
                    icon: detail.type,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#424242',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        Livewire.emit(`delete${event.detail.modelName}s`, detail.ids);
                    }
                });
            });
        });
    </script>
</body>

</html>
