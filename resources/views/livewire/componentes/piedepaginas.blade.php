<section class="bg-[#1F1F1F] py-[5rem] flex md:items-center overflow-x-hidden">

    <div class="grid grid-cols-1 gap-5 md:gap-0 md:grid-cols-4 max-w-full mx-5 md:mx-[5rem]">

        
        <div class="flex flex-row space-x-4 md:justify-center">
            <a href="https://www.instagram.com/petalostextil" target="_blank" rel="noopener noreferrer" class="flex flex-col hover:opacity-80 transition-opacity">
                <img src="{{ asset('imgs/img_sistema/logotipo-de-instagram.png') }}" class="w-[2rem] h-[2rem] object-cover">
            </a>
            <a href="https://www.instagram.com/petalostextil" target="_blank" rel="noopener noreferrer" class="flex flex-col hover:opacity-80 transition-opacity">
                <span class="text-white font-bold md:text-[22px]">Seguinos</span>
                <span class="text-white md:text-[18px]">/petalostextil</span>
            </a>
        </div>

        <div class="flex flex-row space-x-4 md:justify-center">
            <img src="{{ asset('imgs/img_sistema/telefono.png') }}" class="w-[2rem] h-[2rem] object-cover">
            <div class="flex flex-col">
                <span class="text-white font-bold md:text-[22px]">Contacto</span>
                <span class="text-white md:text-[16px]">+54(011) 1234 5678</span>
                <span class="text-white md:text-[16px]">Caballito - CABA</span>
            </div>
        </div>

        <div class="flex flex-row space-x-4 md:justify-center">
            <img src="{{ asset('imgs/img_sistema/enlace.png') }}" class="w-[2rem] h-[2rem] object-cover">
            <div class="flex flex-col">
                <span class="text-white font-bold md:text-[22px]">Links</span>

                <a href="{{ route('politicas-de-cambio') }}" class="text-white md:text-[16px]">
                    Políticas de cambio
                </a>
                <a href="{{ route('preguntas-frecuentes') }}" class="text-white md:text-[16px]">
                    Preguntas frecuentes
                </a>
            </div>
        </div>

        <div class="flex flex-row space-x-4 md:justify-center">
            <img src="{{ asset('imgs/img_sistema/medios-de-pago.png') }}" class="w-[2rem] h-[2rem] object-cover">

            <div class="flex flex-col">
                <span class="text-white font-bold md:text-[22px]">Medios de pago</span>

                <div class="flex flex-wrap gap-2 mt-1">
                    <img src="{{ asset('imgs/img_sistema/link.png') }}" class="h-[2rem] object-cover">
                    <img src="{{ asset('imgs/img_sistema/visa.png') }}" class="h-[2rem] object-cover">
                    <img src="{{ asset('imgs/img_sistema/nativa.png') }}" class="h-[2rem] object-cover">
                    <img src="{{ asset('imgs/img_sistema/banelco.png') }}" class="h-[2rem] object-cover">
                    <img src="{{ asset('imgs/img_sistema/mastercard.png') }}" class="h-[2rem] object-cover">
                    <img src="{{ asset('imgs/img_sistema/naranja.png') }}" class="h-[2rem] object-cover">
                </div>
            </div>
        </div>

    </div>
</section>
