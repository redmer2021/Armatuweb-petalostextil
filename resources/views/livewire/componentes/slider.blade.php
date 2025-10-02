<div>
    <div class="slider w-[60%] mx-auto">
        <div><img class="h-[60vh] w-full" src="/imgs/522278642_17861270310444131_6915188114892089691_n.webp" alt="Foto 1"></div>
        <div><img class="h-[60vh] w-full" src="/imgs/524566380_17861635686444131_5000527782076957372_n.webp" alt="Foto 2"></div>
        <div><img class="h-[60vh] w-full" src="/imgs/527145330_17862336756444131_7099154658963453433_n.webp" alt="Foto 3"></div>
    </div>
</div>

@script
<script>
    document.addEventListener("livewire:navigated", () => {
        $('.slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows:true,
            cssEase: 'linear'
        });
    });
</script>
@endscript

