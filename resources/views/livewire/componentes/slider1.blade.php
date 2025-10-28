<div>
    @if ($renderizar)
        <div class="swiper w-full h-[650px] md:h-full">
            <div class="swiper-wrapper">
                @foreach ($imagenes as $img)
                    <div class="swiper-slide">
                        <img class="w-full h-full object-cover" src="{{ $img }}" alt="slide">
                    </div>
                @endforeach
            </div>
        
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev z-50"></div>
            <div class="swiper-button-next z-50"></div>
            <div class="swiper-scrollbar"></div>
        </div>
    @endif
</div>

@script
    <script>
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 2000,
        },        

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        });

    </script>
@endscript

