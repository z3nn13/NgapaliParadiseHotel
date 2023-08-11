<section class="gallery">
    <h2 class="gallery__title">Click one to <strong class="gallery__title--bold">embark</strong> your journey</h2>
    <div class="gallery__grid">
        @foreach ($categories as $category => $images)
            <div class="category">
                @foreach ($images as $image)
                    <div class="gallery__card 
                    @if ($loop->iteration > 1) hidden @endif"
                        data-category="{{ $category }}">

                        <a class="gallery__card-link"
                            data-lightbox="{{ $category }}"
                            data-title="{{ ucfirst($category) }} Image #{{ $loop->iteration }}"
                            href="{{ asset($image) }}">
                            <img class="gallery__card-image"
                                src="{{ asset($image) }}"
                                alt="{{ $category }} Image {{ $loop->iteration }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
