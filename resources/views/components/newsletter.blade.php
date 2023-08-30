<section class="newsletter">
    <h3 class="newsletter__heading">Newsletter</h3>
    <h2 class="newsletter__title">Subscribe to recieve our latest news and information</h2>

    <form class="newsletter-form"
        method="POST"
        action="{{ route('subscribe') }}">
        @csrf
        <input class="newsletter-form__input"
            name="email"
            type="email"
            placeholder="Your Email">
        <button class="newsletter-form__button"
            type="submit">Submit</button>
    </form>
</section>

@if (session('success'))
    <script type="module">
        Swal.fire({
            title: 'Success',
            text: 'Thanks for subscribing!',
            icon: 'success',
        });
    </script>
@endif
@error('email')
    <script type="module">
        Swal.fire({
            title: 'Subscription Failed!',
            text: 'This email is already subscribed.',
            icon: 'error',
        });
    </script>
@enderror
