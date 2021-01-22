<div class="w-full p-3">
    <div class="bg-white border rounded shadow relative">
        <div class="loading" wire:loading wire:target="submit"><div></div><div></div><div></div><div></div></div>
        <div class="border-b p-3">
            <h5 class="font-bold uppercase text-gray-600">Cadastro de usuário</h5>
        </div>
        <div class="p-5">

            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-2 mb-6">
                    <div class="mr-1">
                        <div>
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Nome
                            </label>
                        </div>
                        <div>
                            <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="" wire:model="name">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Email
                            </label>
                        </div>
                        <div>
                            <input class="form-input block w-full focus:bg-white" id="my-textfield" type="email" value="" wire:model="email">
                            @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>                
                </div>
            
                <div class="grid grid-cols-3 mb-6">
                    <div class="mr-1">
                        <div>
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Senha
                            </label>
                        </div>
                        <div>
                            <input class="form-input block w-full focus:bg-white" id="my-textfield" type="password" value="" wire:model="pass">
                            @error('pass') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mr-1">
                        <div>
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Telefone
                            </label>
                        </div>
                        <div>
                            <input class="form-input block w-full focus:bg-white input-phone" id="my-textfield" type="text" value="" wire:model="phone">
                            @error('phone') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                                Conta
                            </label>
                        </div>
                        <div>
                            <select name="" class="form-select block w-full focus:bg-white" id="my-select" wire:model="account">
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                            @error('account') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            
                <div class="md:flex">
                    <div class="md:w-2/3">
                        <button class="shadow bg-gray-700 hover:bg-gray-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
