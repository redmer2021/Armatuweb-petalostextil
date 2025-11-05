<div class="shadow-lg shadow-[#405D39] rounded-md mt-[7rem] mx-[45rem] p-[2rem] bg-[#FEF0E9]">
    <span class="block text-center text-3xl md:text-4xl font-bold" >Iniciar Sesión</span>
    <div class="mt-[2rem]">
        <label for="txtUserName">Email</label>
        <input id="txtUserName" wire:model="txtUserName" type="text" class="bg-white block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Ingresa su email...">
    </div>
    <div class="mt-[1rem]">
        <label for="txtUserPassword1">Contraseña</label>
        <input id="txtUserPassword1" wire:model="txtUserPassword" type="password" class="bg-white block w-full px-2 py-2 text-md border-[1px] border-gray-400 focus:outline-none focus:ring-0" placeholder="Ingresa tu Contraseña...">
    </div>
    <div class="flex justify-center space-x-3 mt-[2rem]">
        <button wire:click.stop="CancelarLogin()" class="btn-uno">Cancelar</button>
        <button wire:click.stop="Login()" class="btn-uno">Iniciar Sesión</button>
    </div>

    <!-- Mostrar un solo mensaje de error -->
    @if ($errors->any())
        <p class="mt-2 text-sm text-red-600 font-medium">
            {{ $errors->first() }}
        </p>
    @endif
</div>
