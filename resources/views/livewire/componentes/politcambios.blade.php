<div class="py-[4rem]">
    @if ($verPoliticas)
        <div class="flex justify-between items-center bg-white mx-[1rem] md:mx-[12.5rem] border-b-2">
            <h5 class="text-3xl font-semibold">Políticas de cambio</h5>
            <a href="{{ url('/') }}" class="text-[16px]">volver</a>        
        </div>

        <div class="mx-[1rem] md:mx-[12.5rem] mt-[2rem] flex flex-col space-y-6">
            <div>
                <h5 class="font-semibold text-2xl">1. Derecho de arrepentimiento</h5>
                <p class="mt-[8px] text-xl">En Pétalos, respetamos el derecho que tenés de revocar tu compra en un plazo máximo de 10 días corridos desde que recibis el producto. Esto está avalado por la normativa vigente para Comercio Electrónico en Argentina</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">2. Costos de devolución</h5>
                <p class="mt-[8px] text-xl">Los gastos de devolución corren por nuestra cuenta. Vos tenes que poner el producto a nuestra disposición para gestionar la recogida o indicar como lo devolves. Según la normativa, no vas a asumir esos costos en este tipo de devoluciones</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">3. Condiciones del producto</h5>
                <p class="mt-[8px] text-xl">Para que podamos procesar la devolución, el producto debe estar en su empaque original, sin usar, con sus etiquetas (si es que las tiene) y completo con sus embalajes y empaques</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">4. Reembolso</h5>
                <p class="mt-[8px] text-xl">Una vez recibido el producto devuelto y verificado su estado, te haremos el reembolso correspondiente mediante una transferencia al cbu o alias que nos indiques.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">5. Excepciones</h5>
                <p class="mt-[8px] text-xl">Algunas categorías de productos pueden estar excluidas del derecho a arrepentimiento si, por su naturaleza, no se puede devolver, por ejemplo productos personalizados o de rápido deterioro, según lo establece la normativa local.</p>
            </div>
        </div>

    @endif
</div>
