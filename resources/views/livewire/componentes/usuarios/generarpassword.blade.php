<div>
    <div class="bg-gray-300 w-[90%] md:w-[30%] mx-auto p-[0.5rem] md:p-[2rem] rounded-md mt-[6rem]">
        <span class="text-4xl font-bold" >Reiniciando Contraseña...</span>
        <div class="grid grid-cols-2 gap-3 mt-[1rem]">
            <div>
                <label class="text-xs" for="txtUserPassword">Contraseña</label>
                <input id="txtUserPassword" wire:model="txtUserPassword" type="password" class="bg-white block w-full px-2 py-2 text-md border-[1px] @error('txtUserPassword') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Ingresa una password...">
            </div>
            <div>
                <label class="text-xs" for="txtUserPasswordReing">Reingresa la contraseña</label>
                <input id="txtUserPasswordReing" wire:model="txtUserPasswordReing" type="password" class="bg-white block w-full px-2 py-2 text-md border-[1px] @error('txtUserPasswordReing') border-red-500 @else border-gray-400 @enderror focus:outline-none focus:ring-0" placeholder="Reingresa la password...">
                @error('txtUserPasswordReing')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>                        
                @enderror
            </div>
        </div>
        <div class="mt-[1rem] flex justify-end space-x-2">
            <button wire:click.stop="CancelarReinicio()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Cancelar</button>
            <button wire:click.stop="GrabarNuevaPassword()" class="bg-black px-4 py-2 rounded-md cursor-pointer text-white ">Enviar Nueva Contraseña</button>
        </div>
        @if ($errors->has('token'))
            <div class="bg-red-200 text-red-700 p-2 rounded mt-3">
                {{ $errors->first('token') }}
            </div>
        @endif        
    </div>
</div>
