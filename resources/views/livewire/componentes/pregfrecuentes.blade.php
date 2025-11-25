<div class="py-[4rem]">
    @if ($verPoliticas)
        <div class="flex justify-between items-center bg-white mx-[1rem] md:mx-[12.5rem] border-b-2 pb-1">
            <h5 class="text-3xl font-semibold">Preguntas Frecuentes / <span class="font-normal">Devoluciones</span></h5>
            <a href="{{ url('/') }}" class="text-[16px]">volver</a>
        </div>

        <div class="mx-[1rem] md:mx-[12.5rem] mt-[2rem] flex flex-col space-y-6">
            <div>
                <h5 class="font-semibold text-2xl">1. ¿En cuánto tiempo puedo arrepentirme de mi compra?</h5>
                <p class="mt-[8px] text-lg">Tenés 10 días corridos para ejercer tu derecho de arrepentimiento desde que recibís el pedido.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">2. ¿Cómo hago para devolver un producto?</h5>
                <p class="mt-[8px] text-lg">Ingresá al “Botón de Arrepentimiento” en nuestro sitio web, completá el formulario y seguí las instrucciones que te enviamos para devolver el producto. Una vez que solicites la devolución, te enviamos un código de seguimiento de tu trámite.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">3. ¿Tengo que pagar algo para devolver el producto?</h5>
                <p class="mt-[8px] text-lg">No, los costos de envío de devolución corren por nuestra cuenta. Vos sólo tenés que poner el producto a disposición para que lo retiremos o te indicaremos cómo enviarlo de vuelta sin que lo pagues vos.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">4. ¿En qué estado debe estar el producto para devolverlo?</h5>
                <p class="mt-[8px] text-lg">Para que la devolución sea aceptada, el producto debe estar en su estado original, con etiquetas (si las tiene), sin signos de uso o desgaste importante, y en su empaque original.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">5. ¿Cuándo se realiza el reembolso?</h5>
                <p class="mt-[8px] text-lg">Una vez que recibimos el producto devuelto y verificamos que está en condiciones correctas, procesamos el reembolso. El tiempo exacto puede depender del método de pago que hayas utilizado para la compra.</p>
            </div>
        </div>

        <div class="flex justify-between items-center bg-white mx-[1rem] md:mx-[12.5rem] border-b-2 pb-1 mt-[4rem]">
            <h5 class="text-3xl font-semibold">Preguntas Frecuentes / <span class="font-normal">Productos</span></h5>
            <a href="{{ url('/') }}" class="text-[16px]">volver</a>
        </div>

        <div class="mx-[1rem] md:mx-[12.5rem] mt-[2rem] flex flex-col space-y-6">
            <div>
                <h5 class="font-semibold text-2xl">1. ¿Qué tipo de telas usan en los productos?</h5>
                <p class="mt-[8px] text-lg">Todos nuestros productos están confeccionados con telas seleccionadas por su durabilidad, suavidad y calidad. Según la prenda o línea, utilizamos algodón, frisa, lycra, jersey, gabardina u otros textiles resistentes. En cada producto especificamos el material exacto.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">2. ¿Los colores pueden variar respecto a la foto?</h5>
                <p class="mt-[8px] text-lg">Sí, puede haber diferencias mínimas debido a la iluminación en la foto y la calibración de la pantalla de cada dispositivo. De todas formas, intentamos que las fotos representen el color real lo más fiel posible.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">3. ¿Cómo debo cuidar las prendas?</h5>
                <p class="mt-[8px] text-lg">En cada producto incluimos sus cuidados recomendados, pero en general sugerimos:</p>
                <ul class="ml-[2rem] mt-[1rem] list-disc">
                    <li>Lavar con agua fría.</li>
                    <li>Evitar la secadora.</li>
                    <li>No usar blanqueadores.</li>
                    <li>Planchar del revés, si es necesario.</li>
                </ul>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">4. ¿Las medidas son exactas?</h5>
                <p class="mt-[8px] text-lg">No, las medidas pueden tener una tolerancia de entre 1 y 2 cm debido al proceso de confección.</p>
            </div>
            <div>
                <h5 class="font-semibold text-2xl">5. ¿Fabrican productos a pedido o personalizados?</h5>
                <p class="mt-[8px] text-lg">Depende de la línea. Algunos productos pueden personalizarse (colores, medidas o detalles). Si querés algo especial, escribinos y te confirmamos si es posible.</p>
            </div>
        </div>

    @endif
</div>
